// JavaScript for text size adjustment

document.addEventListener('DOMContentLoaded', () => {
    let originalFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize); // 基本フォントサイズを取得

    const adjustTextSize = (scaleFactor) => {
        document.querySelectorAll('main p, main li, main a').forEach(element => {
            let currentFontSize = parseFloat(getComputedStyle(element).fontSize);
            let newFontSize = (currentFontSize / originalFontSize) * scaleFactor;
            element.style.setProperty('font-size', newFontSize + 'rem', 'important');

            if (element.tagName.toLowerCase() === 'p') {
                element.style.setProperty('line-height', newFontSize * 1.5 + 'rem', 'important'); // 行間を調整
            }

            if (element.tagName.toLowerCase() === 'li') {
                element.style.setProperty('padding-bottom', newFontSize * 0.5 + 'rem', 'important'); // li間のスペースを調整
            }
        });
    };

    document.getElementById('bigger-text-size').addEventListener('click', () => {
        adjustTextSize(1.1); // 1.1倍にする
    });

    document.getElementById('smaller-text-size').addEventListener('click', () => {
        adjustTextSize(0.9); // 0.9倍にする
    });

    document.getElementById('reset-text-size').addEventListener('click', () => {
        document.querySelectorAll('main p, main li, main a').forEach(element => {
            element.style.removeProperty('font-size');
            element.style.removeProperty('line-height');
            element.style.removeProperty('padding-bottom');
        });
    });
});


/** 
document.addEventListener('DOMContentLoaded', () => {
    let originalFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize); // 基本フォントサイズを取得


    document.getElementById('bigger-text-size').addEventListener('click', () => {
        document.querySelectorAll('main p, main li, main a').forEach(element => {

            let currentFontSize = parseFloat(getComputedStyle(element).fontSize);

            element.style.fontSize = (currentFontSize / originalFontSize) * 1.1 + 'rem', 'important';
        });
    });

    document.getElementById('smaller-text-size').addEventListener('click', () => {
        document.querySelectorAll('main p, main li, main a').forEach(element => {
            
            let currentFontSize = parseFloat(getComputedStyle(element).fontSize);

            element.style.fontSize = (currentFontSize / originalFontSize) * 0.9 + 'rem', 'important';
        });
    });

    document.getElementById('reset-text-size').addEventListener('click', () => {
        document.querySelectorAll('main p, main li, main a').forEach(element => {
            
            let currentFontSize = parseFloat(getComputedStyle(element).fontSize);

            element.style.fontSize = '';
        });
    });

});

*/