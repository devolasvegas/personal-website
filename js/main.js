window.addEventListener('scroll', parallaxBhvr);

function parallaxBhvr() {
    var scrollTop = window.scrollY;
    var bgPos = scrollTop / -9 + 'px';
    var plxSections = document.querySelectorAll('.parallax');
    for(var i = 0; i < plxSections.length; i++) {
        var plxSection = plxSections[i];
        plxSection.style.backgroundPosition = '50%' + bgPos;
    }
}