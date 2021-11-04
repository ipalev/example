$(document).ready(function (){
    let instance = {
        'suggestionsToken': suggestionsToken,
        'mainRows': document.querySelector('[data-personal="form-personal"]')
    };

    let addressField = document.querySelector('[data-address="DELIVERY_ADDR"]');

    let locationField = document.querySelector('#ORDER_LOCATION');


    let $suggestions = $(addressField).suggestions({
        token: instance.suggestionsToken,
        type: "ADDRESS",

        onSelect: function (suggestion) {
            if(!suggestion.data) {
                return;
            }

            let street = instance.mainRows.querySelector('[data-code="DELIVERY_STREET"]');
            let house = instance.mainRows.querySelector('[data-code="DELIVERY_HOUSE"]');
            let flat = instance.mainRows.querySelector('[data-code="DELIVERY_FLAT"]');

            if(street) street.value = suggestion.data.street;
            if(house) house.value = suggestion.data.house;
            if(flat) flat.value = suggestion.data.flat;

            $.ajax({
                url:'/ajax/sale/geo/bx_location_code/',
                type: 'post',
                data: {
                    dadata_array: suggestion.data
                },
                success: function(response){
                    if(response.success) {
                        locationField.value = response.data.location_code;
                        locationField.dispatchEvent(new Event('change'));
                    } else {
                        BX.Sale.OrderAjaxComponent.sendRequest();
                        document.dispatchEvent(
                            new CustomEvent('soa:failed-location-response', {
                                detail:{
                                    suggestion_data: suggestion,
                                    response: response,
                                }
                            })
                        );
                    }
                }
            })
        }

    });

    $suggestions.suggestions().fixData();
});

