document.addEventListener('deferred-load:force', function(){
    let allDefBlocks = document.querySelectorAll('[data-deferredload-marker]');
    if(allDefBlocks.length) {
        Array.from(allDefBlocks).forEach(function(element){
            let deferredBlockMarker = element.dataset.deferredloadMarker;
            if(deferredBlockMarker) {
                BX.ajax({
                    method: 'GET',
                    url: BX.util.add_url_param(location.href,
                    {
                        "request-action": "deferredload",
                        "deferred_block_marker": deferredBlockMarker
                    }),
                    headers: [
                        {
                            name: 'X-Requested-With', value: 'deferredload'
                        },
                        {
                            name: 'Accept', value: 'text/html, application/xhtml+xml'
                        },
                    ],
                    onsuccess: function (data) {
                        let obNew = BX.processHTML(data, true);
                        BX.ajax.processScripts(obNew.SCRIPT, true);
                        element.insertAdjacentHTML('afterend', obNew.HTML);
                    },
                    onfailure : function()
                    {
                        console.log('deferredload component: failed to load deferred block \'' + deferredBlockMarker + '\'');
                    }
                });
            }
        });
    }
});