/*global module:false*/
module.exports = function(grunt) {

  // Load JSON config
  var appConfig = grunt.file.readJSON('app_config.json');

  // Load all grunt tasks.
  require('load-grunt-tasks')(grunt);

  // Show elapsed time.
  require('time-grunt')(grunt);

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    compass: {
      dist: {
        options: {
          sassDir: 'sass',
          cssDir: '.',
          imagesDir: 'images',
          generatedImagesDir: 'images',
          javascriptsDir: 'js',
          outputStyle: 'compressed',
          force: true,
          importPath: 'bower_components/foundation/scss',
          sourcemap: true
        }
      }
    },
    concat: {
      options: {
        banner: '<%= banner %>',
        stripBanners: true,
        nonull: true,
      },
      js: {
        src: ['js/lib/sticky-footer.js', 'js/src/*.js', '!js/src/customizer.js'],
        dest: 'js/greatoutdoors.min.js'
      }
	},
    uglify: {
      options: {
        banner: '<%= banner %>'
      },
	  customizer: {
	    src: 'js/src/customizer.js',
	    dest: 'js/customizer.min.js'
      },
      dist: {
        files: [
          {
            expand: true,
            cwd: 'js',
            src: ['greatoutdoors.min.js'],
            dest: 'js',
            ext: '.min.js'
          },
        ]
      }
    },
    copy: {
      dev: {
        files: [
          {src: ['js/src/customizer.js'], dest: 'js/customizer.min.js'},
        ]
      }
    },
    jshint: {
      options: {
        reporter: require('jshint-stylish')
      },
      js: {
        options: {
          curly: true,
          eqeqeq: true,
          immed: true,
          latedef: true,
          newcap: true,
          noarg: true,
          sub: true,
          undef: true,
          unused: true,
          boss: true,
          eqnull: true,
          browser: true,
          globals: {
            jQuery: true,
            $: true,
          },
        },
        files: {
          src: ['js/*.js']
        },
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      lib_test: {
        src: ['js/*.js']
      }
    },
    browserSync: {
      dev: {
        bsFiles: {
          src: [
            '*.css',
            '**/*.php',
            'images/*.jpg',
            'images/*.png',
          ],
        },
        options: {
          watchTask: true,
          debugInfo: true,
          logConnections: true,
          notify: true,
          proxy: appConfig['proxy'],
          ghostMode: {
            scroll: true,
            links: true,
            forms: true
          }
        }
      }
    },
    phpdocumentor: {
      dist: {
        options: {
          ignore: 'node_modules'
        }
      }
    },
    watch: {
      gruntfile: {
        files: '<%= jshint.gruntfile.src %>',
        tasks: ['jshint:gruntfile']
      },
      options: {
        livereload: true,
      },
      sass: {
        files: ['sass/**/*.scss'],
        tasks: ['compass:dist'],
      },
      js: {
        files: ['js/*.js'],
        tasks: ['jshint:js'],
        options: {
            spawn: false,
        },
      },
    },
  });

  // Default task.
  grunt.registerTask('default', ['dev']);
  grunt.registerTask('dev', ['concat:js', 'copy:dev', 'browserSync', 'watch']);
  grunt.registerTask('build', ['concat:js', 'uglify', 'compass:dist']);
  grunt.registerTask('lint', ['jshint']);
  grunt.registerTask('docs', ['phpdocumentor']);
};
