
# IMPORT USEFUL LIBRARIES
import panel as pn
import numpy as np
import matplotlib.pyplot as plt
import math
from matplotlib.figure import Figure
from matplotlib import cm



def LRD_calc(LRD_dia,LRD_hei,axes_horz_dist,axes_vert_dist,mooring_decl):

    # Fixed inputs
    LRD_des_depth = 100
    LRD_vol = np.pi*(LRD_dia/2)**2*LRD_hei
    ballast_rho = 3500
    
    # Structural weight estimate
    LRD_mat_Sy = 355
    load_factor = 1.35
    mat_factor = 1.15
    mat_den = 7850              # Material (Steel) density (kg/m3)
    den_water = 1025            # Density of water (kg/m3)
    g = 9.81                    # Gravitational acceleration (m/s2)
    hydro_pres = den_water*g*LRD_des_depth/1000         # Hydrostatic pressure (kPa)
    tube_wall_t = max(0.01, hydro_pres*load_factor*(LRD_dia/2)/(LRD_mat_Sy*1000/mat_factor))      # Tube wall thickness
    tube_vol = tube_wall_t*2*np.pi*(LRD_dia/2)*LRD_hei                                          # Volume of tube
    tube_mass = tube_vol*7.85
    
    # Topcap (assuming unreinforced plate)
    topcap_Mc2 = (3+0.3)/16*hydro_pres*1000*(LRD_dia/2)**2 # from Roark's
    topcap_t = min(tube_wall_t*3,np.sqrt(topcap_Mc2*6/(LRD_mat_Sy))/1000)   #minimum thickness (unreinforced) to maintain stress below allowable yield (reduced to 3x tube thickness 20230808)
    topcap_vol = topcap_t*np.pi*(LRD_dia/2)**2
    topcap_mass = topcap_vol*mat_den/1000       #mass in tonnes
    
    #Bottom cap (assuming no or negligible hydrostatic pressure prior to ballast fill)
    botcap_t = tube_wall_t
    botcap_vol = botcap_t*np.pi*(LRD_dia/2)**2
    botcap_mass = botcap_vol* mat_den/1000      # mass in tonnes
    
    # Scantling
    scant_ratio = 0.50       #increased from 0.2 based on LRD sizing calc 20230726
    scant_vol = (tube_vol + topcap_vol + botcap_vol)*scant_ratio
    scant_mass = scant_vol*mat_den/1000           #tonnes
    
    # weight distribution
    LRD_str_wt = tube_mass + topcap_mass + botcap_mass + scant_mass
    LRD_disp = LRD_vol * 1.025          #tonnes
    LRD_ballast_wt = LRD_disp - LRD_str_wt      #tonnes
    LRD_ballast_vol = 1000*LRD_ballast_wt/ballast_rho       # cubic metres
    LRD_ballast_h = LRD_ballast_vol/(np.pi*(LRD_dia/2)**2)
    LRD_CoG = -LRD_hei+((LRD_ballast_wt*(LRD_ballast_h/2))+((tube_mass+scant_mass)*(LRD_hei/2))+(topcap_mass*(LRD_hei-topcap_t/2))+(botcap_mass*botcap_t/2))/(LRD_ballast_wt+LRD_str_wt)
    LRD_CoB = -LRD_hei/2        # local co-ordinate system
    
    # ARM GEOMETRY
    arm_length =(np.sqrt((((LRD_dia/2)+axes_horz_dist)**2)+(((LRD_hei-axes_vert_dist)/2)**2)))*1.275   # Factor here applied based on trial and error
      
    # Stability calculator
    # Calculate rotation of LRD
    
    x = (LRD_CoB-LRD_CoG)/2
    y = np.sqrt(axes_horz_dist**2 + (axes_vert_dist/2)**2)
    alpha = np.arctan(axes_horz_dist/(axes_vert_dist/2))*180/np.pi
    
    ###min_decl = 30; max_decl = 90; spacing = 1
    ##mooring_decl = np.arange(min_decl, max_decl, spacing)
    ###num = int((mooring_angle - min_decl)/spacing)
    
    nsize = 200
    line_tension = []
    for i in range(30, nsize+1):
        add_on = (1.05**(i-29))
        line_tension.append(add_on)
    line_tension = np.concatenate((np.linspace(0, 0.009, 10), np.linspace(0.01, 0.1, 10), np.linspace(0.2, 1, 9), line_tension))
    
    LRD_rotation = []
    LRD_extension = []
    #for i in range(len(mooring_decl)):
    rotation_row = []
    extension_row = []
    for j in range(len(line_tension)):
          LRD_rotation_row =min(180-mooring_decl+alpha, np.arctan(2*line_tension[j]*y*np.sin((mooring_decl-alpha)*np.pi/180)/(((LRD_disp-(-LRD_disp))*x-2*line_tension[j]*y*np.cos((mooring_decl-alpha)*np.pi/180))))*180/np.pi)
          if LRD_rotation_row < 0:  
             LRD_rotation_row = 180 + LRD_rotation_row
          LRD_extension_row = 2*arm_length - 2*y*np.cos((LRD_rotation_row + mooring_decl - alpha)*np.pi/180)
          rotation_row.append(LRD_rotation_row)
          extension_row.append(LRD_extension_row)
    extension_row = extension_row - min(extension_row)
    LRD_rotation.append(rotation_row)
    LRD_extension = extension_row
    
    
    line_tension_diff = np.subtract(line_tension[1:len(line_tension)], line_tension[0:len(line_tension)-1])
    LRD_extension_diff = np.subtract(LRD_extension[1:len(LRD_extension)], LRD_extension[0:len(LRD_extension)-1])
    slope = np.divide(line_tension_diff, LRD_extension_diff)
    
    min_count = np.argmin(slope) # obtain the index of the minimum value in slope
    max_count = np.argmax(slope) # Obtain the index of the maximum value in slope
    
    T_inflx = line_tension[min_count]
    X_inflx = LRD_extension[min_count]
    c_inflx =  T_inflx - min(slope) * X_inflx
    
    T_Xmax = line_tension[max_count]
    X_Xmax = LRD_extension[max_count]
    c_Xmax =  T_Xmax - max(slope) * X_Xmax
    
    slope_X0 = slope[1]
    T_X0 = line_tension[1]
    X_X0 = LRD_extension[1]
    c_X0 =  T_X0 - slope_X0 * X_X0
    
    # calculate line angles between phase 1 and phase 2
    
    X_ph1_ph2 = (c_inflx - c_X0) / (slope_X0 - min(slope))
    T_ph1_ph2 = X_ph1_ph2 * slope_X0 + c_X0
    ##  slope_ph1_ph2 = (slope_inflx * slope_X0 - sqrt(1+slope_inflx^2)*sqrt(1+slope_X0^2)-1)/(slope_inflx+slope_X0); % actual slope between the 2 lines
    slope_ph1_ph2 = 2*(-T_inflx/X_inflx)
    c_ph1_ph2 = T_ph1_ph2-(slope_ph1_ph2*X_ph1_ph2)
    
    # calculating line angles between phase 2 and phase 3
    
    X_ph2_ph3 = (c_inflx - c_Xmax) / (max(slope) - min(slope))
    T_ph2_ph3 = X_ph2_ph3 * min(slope) + c_inflx
    ##  slope_ph2_ph3 = (slope_inflx * slope_Xmax - sqrt(1+slope_inflx^2)*sqrt(1+slope_Xmax^2)-1)/(slope_inflx+slope_Xmax); % actual slope between the 2 lines
    slope_ph2_ph3 = 2*(-T_inflx/X_inflx)
    c_ph2_ph3 = T_ph2_ph3-(slope_ph2_ph3*X_ph2_ph3)
    
    #calculate distance to curve
    
    dist_ph1_ph2 = np.sqrt((c_ph1_ph2 + slope_ph1_ph2 * LRD_extension - line_tension)**2/(slope_ph2_ph3**2+1))
    dist_ph2_ph3 = np.sqrt((c_ph2_ph3 + slope_ph2_ph3 * LRD_extension - line_tension)**2/(slope_ph2_ph3**2+1))
    
    
    min_counter_1a = np.argmin(dist_ph1_ph2)
    T_MWL = line_tension[min_counter_1a]
    X_MWL = LRD_extension[min_counter_1a]
    
    min_counter_1b = np.argmin(dist_ph2_ph3)
    T_SWL = line_tension[min_counter_1b]
    X_SWL = LRD_extension[min_counter_1b]
    
    SWL = T_SWL                                     # T safe working load
    MBL = 2*SWL                                     # T minimum breaking load
    k_op = 9.81* (T_SWL - T_MWL)/(X_SWL - X_MWL)    # kN/m operating range stiffness
    x_op = X_SWL - X_MWL                            # Operational extension


    fig = plt.Figure(figsize=(3, 2.1))
            
    plt.clf()
    plt.plot(LRD_extension, line_tension,'b-',label='LRD stiffness')
    plt.plot(X_SWL,T_SWL,'ro',label='Safe Working Load')
    plt.axis([0,max(LRD_extension),0,T_SWL*2.5])
    plt.xlabel('Extension (m)')
    plt.ylabel('Tension (tonnes)')
    plt.legend(loc='upper left')
    plt.title(None)
    plt.grid(True)
    plt.show()
    #plt.close()
   

    return plt #line_tension, LRD_extension, T_SWL, X_SWL, k_op 


# input LRD geometry 
# LRD diameter
LRD_dia = pn.widgets.FloatSlider(name="LRD diameter, D (m)", value=3.75, start=2.5, end=5, step=0.05)

# LRD overall length / height

LRD_hei = pn.widgets.FloatSlider(value=17.5, start=10, end=22.5, step=0.25, name='LRD overall length, L (m)')

# LRD axes positions - horizontal
axes_horz_dist = pn.widgets.FloatSlider(value=0, start=-1, end=2, step=0.1, name='LRD axes distance from centreline, H (m)')

# LRD axes positions - vertical
axes_vert_dist = pn.widgets.FloatSlider(value=5, start=2, end=10, step=0.1, name='LRD axes vertical separation, V (m)')

# Mooring declination angle
mooring_decl = pn.widgets.FloatSlider(value=70, start=30, end=85, step=1, name='Mooring line declination (degrees from vertical)')

#pn.Column(LRD_dia, LRD_hei, axes_horz_dist,axes_vert_dist,mooring_decl).servable(target='simple_app')


#line_tension, LRD_extension, T_SWL, X_SWL, k_op = LRD_calc(LRD_dia,LRD_hei,axes_horz_dist,axes_vert_dist,mooring_decl)

dynamic_plot = pn.bind(LRD_calc, LRD_dia, LRD_hei, axes_horz_dist,axes_vert_dist,mooring_decl)

#pn.extension()

#layout = pn.Row(
#    pn.Column(LRD_dia, LRD_hei, axes_horz_dist,axes_vert_dist,mooring_decl),
#    dynamic_plot
#)


pn.Row(pn.Column(LRD_dia, LRD_hei, axes_horz_dist,axes_vert_dist,mooring_decl),dynamic_plot).servable(target='simple_app')





