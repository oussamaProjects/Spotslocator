 

const { watch, src, dest} = require('gulp');
const postcss = require('gulp-postcss')
 
const dir_sass  = 'src/css/*';

exports.default = function() {
    
  watch(dir_sass, 
    function(){
        return src(dir_sass)
        .pipe(postcss([
            require('tailwindcss'),
            require('autoprefixer'),
        ]))
        .pipe(dest('./public/css/'))
    }
  ); 
};