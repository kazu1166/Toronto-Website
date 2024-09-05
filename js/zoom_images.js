// JavaScript for zoomable images


document.querySelectorAll('.zoomable').forEach(image => {
    image.addEventListener('click', () => {
        if (image.classList.contains('zoomed')) {
            image.classList.remove('zoomed');
            image.style.transform = 'scale(1)';
            image.style.zIndex = '1';
            image.style.transformOrigin = ''; // 拡大の基準をリセット
        } else {
            // 他のズームされた画像があればリセットする
            document.querySelectorAll('.zoomed').forEach(zoomedImage => {
                zoomedImage.classList.remove('zoomed');
                zoomedImage.style.transform = 'scale(1)';
                zoomedImage.style.zIndex = '1';
                zoomedImage.style.transformOrigin = '';
            });

            if (!image.classList.contains('immigrant') && image.classList.contains('left')) {
                image.style.transformOrigin = 'top left';
                image.style.transform = 'scale(2)';
            
            } else if (!image.classList.contains('immigrant') && image.classList.contains('right')) {
                image.style.transformOrigin = 'top right';
                image.style.transform = 'scale(2)';

            } else if (image.classList.contains('immigrant') && image.classList.contains('left')) {
                image.style.transformOrigin = 'top left';
                image.style.transform = 'scale(1.7)';
                
            } else if (image.classList.contains('immigrant') && image.classList.contains('right')) {
                image.style.transformOrigin = 'top right';
                image.style.transform = 'scale(2)';
                
            }
            image.classList.add('zoomed');
            image.style.position = 'relative';
            image.style.zIndex = '500';

        }
    });
});



/** 
document.querySelectorAll('.zoomable').forEach(image => {
    image.addEventListener('click', () => {
      if (image.classList.contains('zoomed')) {
        image.classList.remove('zoomed');
        image.style.transform = 'scale(1)';
        image.style.position = '';
        image.style.zIndex = '1';
        image.style.backgroundColor = '';
      } else {
        image.classList.add('zoomed');
        image.style.position = 'absolute';
        image.style.top = rect.top + scrollTop + 'px';
        image.style.left = rect.left + scrollLeft + 'px';
        image.style.width = rect.width + 'px'; // 元の幅を設定
        image.style.height = rect.height + 'px'; // 元の高さを設定
        //image.style.transformOrigin = 'center center'; // 拡大の基準点を中央に設定
        image.style.transform = 'scale(2)'; // 必要に応じて調整
        image.style.zIndex = '10000';
        image.style.backgroundColor = 'white';
      }
    });
  });
  */
  