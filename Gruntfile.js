module.exports = function (grunt) {
	grunt.initConfig({

		js_import : function(filename) { return grunt.file.read('src/js/' + filename + ".js"); },
		
		concat : {
			options : { process : true },
			site : {
				files : {
					"./js/site.js" : "./src/js/site.js"
				}
			}
		},

		stylus : {
			options : { pretty : true, compress : false },
			style : {
				files : {
					'./style.css' : './src/style/style.styl'
				}
			}
		},

		watch : {
			options : { nospawn : false, event: 'all', interrupt : false, interval : 200, debounceDelay: 200 },
			js : { files : './src/js/**/*.js', tasks : ['concat:site']},
			style : { files : './src/style/**/*.styl', tasks : ['stylus:style'] },
		},


	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('develop', ['concat:site','stylus:style', 'watch']);
}