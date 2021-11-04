"use strict";

let initProductSlider = function (blockCode) {
    initSlider();

    let tab = document.querySelector(`[href="#${blockCode}"]`);
    let block = document.getElementById(blockCode);
    let blockList = block.parentNode;

    if(tab && block) {
        tab.classList.remove('u-hidden')
        block.classList.remove('u-hidden')
    }

    if(!blockList.querySelector('[role="tabpanel"].active:not(.u-hidden)')) {
        let firstBlock = blockList.querySelector('[role="tabpanel"]:not(.u-hidden)');

        if(firstBlock) {
            document.querySelectorAll(`[href="#${firstBlock.id}"]`).forEach(el => {
                el.classList.add('active');
            });

            firstBlock.classList.add('active', 'show');
        }
    }
}

document.addEventListener('rcm-section:successShownAction', e => {
    if(!e.detail.requestData || !e.detail.requestData.container) return;

    let containerName = e.detail.requestData.container.substring('container-'.length)
    initProductSlider(containerName)
});

document.addEventListener('ContentDeferredDone', e => {
    const catalogElementSlider = ['slider-latest'].indexOf(e.detail.deferred_block_id) !== -1;

    if(!catalogElementSlider) return;

    initProductSlider(e.detail.deferred_block_id);
})