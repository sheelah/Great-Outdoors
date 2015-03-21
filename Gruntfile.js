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
    autoprefixer: {
      options: {
        map: true,
        browsers: ['last 2 versions', 'ie 9']
      },
      dist: {
        files: [{
          expand: true,
          cwd: '.',
          src: ['style.css, editor-style.css'],
          dest: '.'
        }]
      }
    },
    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss'],
        sourceMap: true,
        // Include sources in source map file since otherwise paths are wrong
        sourceMapContents: true
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'style.css': 'sass/style.scss'
        }
      },
      dev: {
        options: {
          outputStyle: 'expanded'
        },
        files: {
          'style.css': 'sass/style.scss',
          'editor-style.css': 'sass/editor-style.scss',
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
        tasks: ['sass:dev', 'autoprefixer'],
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
  grunt.registerTask('build', ['concat:js', 'uglify', 'sass:dist', 'autoprefixer']);
  grunt.registerTask('lint', ['jshint']);
  grunt.registerTask('docs', ['phpdocumentor']);
};
