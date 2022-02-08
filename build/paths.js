const path = require('path')

// I'm really just guessing your project's folder structure from reading your question,
// you might want to adjust this whole section
module.exports = {
    // The base path of your source files, especially of your index.js
    SRC: path.resolve(__dirname, '..', 'resources'),

    // The path to put the generated bundle(s)
    DIST: path.resolve(__dirname, '..', 'public', ''),

}