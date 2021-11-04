"use strict";

document.addEventListener('DOMContentLoaded', function (){
    $(document).on('click', '.js__pagination', event => {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        let el = event.target.closest('.js__pagination');
        let pagen = el.dataset.paginationId;
        let url = el.dataset.url;
        let removeContent = typeof el.dataset.removeContent !== 'undefined';

        let containerSelector = `[data-container-pagination-id="${pagen}"]`;
        let targetContainer = document.querySelector(containerSelector);

        if(pagen && url && targetContainer) {
            $.ajax({
                type: 'get',
                url: url,
                data: {pagination_type: pagen},
                dataType: 'json',
                success: function (data) {
                    let newBtn = data.pagination;
                    let newContent = data.items;
                    if(newBtn) el.insertAdjacentHTML('afterend', newBtn);
                    el.remove();

                    if(removeContent) targetContainer.innerHTML = '';
                    if(newContent) targetContainer.insertAdjacentHTML('beforeend', newContent);

                    let observeItems = document.querySelectorAll('.js-observe');
                    for (var i = 0; i < observeItems.length; i++) {
                        console.log(observeItems[i]);
                        observeItems[i].classList.add('is-visible');
                    }

                    let pagenEvt =
                        new CustomEvent('onPagenContentLoaded', {
                            detail: {
                                containerSelector: containerSelector,
                                name: pagen
                            }
                        });
                    document.dispatchEvent(pagenEvt);
                }
            })
        }
    });
})