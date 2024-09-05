// tet_space.js

function padString(elementId, targetLength) {
    const element = document.getElementById(elementId);
    let text = element.textContent;

    // when word count does't reach targetLength, add add white spaces to end of word
    if (text.length < targetLength) {
        text = text.padEnd(targetLength, ' ');
        element.textContent = text;
    }
}

padString('text', 10);  // now not available