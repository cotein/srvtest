window.Vue = require('vue');
import Vuex from 'vuex';
Vue.use(Vuex);

import app from './modules/app';
import colour from './modules/colour';
import products from './modules/app/Products';
import categories from './modules/categories';
import ivas from './modules/ivas';
import money from './modules/money';
import buying_mode from './modules/buying_mode';
import user from './modules/user';
import subcategories from './modules/subcategories';
import item_condition from './modules/item_condition';
import variations from './modules/variations';
import suppliers from './modules/suppliers';
import brands from './modules/brands';
import attributes from './modules/attributes';
import notifications from './modules/notifications';
import publications from './modules/web/publications';
import publish from './modules/app/publish';
import publications_from_here from './modules/app/publications';
import newsletter from './modules/web/newsletter';
import detail_product from './modules/web/product_detail';
import brands_web from './modules/web/brands';
import filters from './modules/web/filters';
import OrdersMeli from './modules/mercadolibre/Orders';
import orders from './modules/app/orders';
import search from './modules/web/search';
import cart from './modules/web/cart';
import provinces from './modules/web/provinces';
import countries from './modules/web/countries';
import cities from './modules/web/cities';
import pedidos from './modules/app/pedidos';
import billiable_products from './modules/app/billable-products';
import VuexPersist from 'vuex-persist';
import vouchers from './modules/app/vouchers';
import customers from './modules/app/Customer';
import wspuc from './modules/afip/WSPUC';
import wsfe from './modules/afip/wsfe';
import modal_error from './modules/modal_error';
import Provider from './modules/app/Provider/index';
import sale_invoice from './modules/app/SaleInvoice';
import PurchaseInvoice from './modules/app/Purchaser/Iva';
import price_lists from './modules/app/PriceLists';
import pedidos_clientes from './modules/app/pedidos_clientes';
import arba from './modules/arba/arba';
import CustomersList from './modules/app/CustomerList';
import CustomersData from './modules/app/CustomerData';
import AddressType from './modules/app/AddressType';
import Address from './modules/app/Address';
import CustomerInvoicesList from './modules/app/CustomerInvoiceList';
import PedidosClientesStatus from './modules/app/PedidosClientesStatus';
import PedidosClientesEdit from './modules/app/PedidosClientesEdit';
import CustomerRecibo from './modules/app/CustomerRecibo';
import mercadolibre_publications from './modules/mercadolibre/Publications';
import MeasurementUnities from './modules/app/MeasureUnity';
import Article from './modules/app/Article';
import AccountingAccount from './modules/app/AccountingAccounts';
import Tax from './modules/app/Taxes/';
import TaxesTypes from './modules/app/Taxes/Type';
import PurchaserDocuments from './modules/app/PurchaserDocuments';
import Inscriptions from './modules/app/Inscriptions';
import ProviderErrors from './modules/app/ProviderErrors';
import PurchaseInvoiceErrors from './modules/app/PurchaseInvoiceErrors';
import PurchaseInvoiceList from './modules/app/PurchaseInvoiceList';
import PurchaseInvoiceToPay from './modules/app/PurchaseInvoiceToPay';
import PublicationList from './modules/mercadolibre/PublicationList';
import Variation_meli from './modules/mercadolibre/Variations';
import OrderPayment from './modules/app/OrderPayment';
import ReceiptToProviders from './modules/app/ReceiptToProviders';
import ReceiptToProvidersList from './modules/app/ReceiptToProvidersList';
import CustomerNew from './modules/app/CustomerNew';
import CustomerErrors from './modules/app/CustomerErrors';
import Questions from './modules/mercadolibre/Questions';
import MetricVisits from './modules/mercadolibre/MetricVisits';
import Messages from './modules/mercadolibre/Messages';
import PaymentType from './modules/app/PaymentType';
import UserCommission from './modules/app/UserCommission';
import ActivateUser from './modules/Admin/ActivateUser/index';
import Roles from './modules/Admin/Roles/index';
import IvaCompras from './modules/app/Provider/IvaCompras/';
import Company from './modules/app/Company';
const vueLocalStorage = new VuexPersist({
    key: 'vuex',
    storage: window.sessionStorage,
    modules : ['cart', 'PurchaseInvoiceToPay', 'Messages', 'OrdersMeli', 'Company']
});

export const store = new Vuex.Store({
    modules : {
        app,
        products,
        colour,
        categories,
        ivas,
        money,
        buying_mode,
        user,
        subcategories,
        item_condition,
        variations,
        publications,
        suppliers,
        brands,
        attributes,
        notifications,
        publish,
        publications_from_here,
        newsletter,
        detail_product,
        brands_web,
        filters,
        search,
        OrdersMeli,
        orders,
        cart,
        provinces,
        countries,
        cities,
        pedidos,
        billiable_products,
        vouchers,
        customers,
        wspuc,
        Company,
        wsfe,
        modal_error,
        Provider,
        PurchaseInvoice,
        sale_invoice,
        CustomerInvoicesList,
        price_lists,
        pedidos_clientes,
        arba,
        CustomersList,
        CustomersData,
        AddressType,
        Address,
        PedidosClientesStatus,
        PedidosClientesEdit,
        CustomerRecibo,
        mercadolibre_publications,
        MeasurementUnities,
        Article,
        AccountingAccount,
        Tax,
        TaxesTypes,
        PurchaserDocuments,
        Inscriptions,
        ProviderErrors,
        PurchaseInvoiceErrors,
        PurchaseInvoiceList,
        PurchaseInvoiceToPay,
        PublicationList,
        Variation_meli,
        OrderPayment,
        ReceiptToProviders,
        ReceiptToProvidersList,
        CustomerNew,
        CustomerErrors,
        Questions,
        MetricVisits,
        Messages,
        PaymentType,
        UserCommission,
        ActivateUser,
        Roles,
        IvaCompras

    },
    plugins: [vueLocalStorage.plugin]

});