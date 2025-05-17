import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import browserslist from "browserslist";
import { browserslistToTargets } from "lightningcss";
import { globSync } from 'glob';
import { resolve } from "path";

const input = globSync([
	'assets/scss/index.{js,scss}',
	'assets/scss/templates/*.scss',
	'assets/js/templates/*.js'
]).map(
	path => resolve(process.cwd(), path)
);

export default defineConfig ({
	css: {
		transformer: 'lightningcss',
		lightningcss: {
			drafts: {
				customMedia: true
			},
			targets: browserslistToTargets(browserslist('>= 0.25%'))
		}
	},
	plugins: [
		laravel({
			input: input,
			refresh: [
				"site/templates/**",
				"site/snippets/**",
			],
			publicDirectory: "./"
		})
	],
	build: {
		cssMinify: 'lightningcss'
	}
});