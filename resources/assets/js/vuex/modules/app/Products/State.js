const state = {

    loading_products : false,
    submitted : false,
    list_products : [],
    products : [],
    products_loading : false,
    product_quick_view : [],
    others_attributes : [],
    product : {
        price_list : {
            id:4,
            name:"Mercado libre"
        },
        name : null,
        code : null,
        category : null,
        sub_category : null,
        path_from_root : null,
        stock : null,
        original_price : null,
        sale_price : null,
        color : null,
        size : null,
        supplier : null,
        brand : null,
        priority : 10,
        iva : {"id":6,"code":"5","name":"21%","percentage":"21","created_at":"2019-04-15 16:23:30","updated_at":"2019-04-15 16:23:30"},
        money : {'code' : 'PES',  'name' : 'PESOS', 'symbol' : '$',  'value': 1, 'description'	: 'name'},
        buying_mode : {'name' : 'buy_it_now'},
        available_total : 1,
        available_quantity : 0,
        listing_type : {
            "site_id": "MLA",
            "id": "gold",
            "name": "Oro"
        },
        attr_item_condition : {'name':"Nuevo", 'value_id':"2230284"},
        description : null,
        pictures : [
            {source : 'https://pixabay.com/en/blossom-bloom-flower-195893/'}
        ],
        video_id : null,
        sale_terms : [],
        attributes : {
            color : null,
            size : null
        },
        others_attributes : [],
        variation : {
            price : null,
            available_quantity : 1,
            sold_quantity : 0,
            attribute_combinations : [],
            attributes : [],
            picture_ids : []
        }
    },

    row: {
        price : null,
        available_quantity : 0,
        attribute_combinations : []
    }
}

export default state;