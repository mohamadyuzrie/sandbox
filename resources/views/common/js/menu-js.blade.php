let addressBarUrl = ''
let addressArray = window.location.pathname.split('/')

/**
 * the following loop is used to generate a long enough string to know which page is currently active
 *
 * the loop is starting from index: 1 because index: 0 will always be empty
 * we want to stop the address dynamically before a specific id is selected, so we go on until a number is found and stop there
 * e.g.: in edit page: /inbound/goods-receive/1/edit, we want to stop until /inbound/goods-receive
 * */
for (let index = 1; index < addressArray.length; index++) {
    if (!isNaN(addressArray[index]) || addressArray[index] == 'create') break;
    addressBarUrl = addressBarUrl.concat(`/${addressArray[index]}`);
}

let activePage = $('ul.nav-sidebar a').filter(function () {
    // regex: /.*\/\/[^\/]*/
    // replacement: ''
    // searches for the front part of the url; i.e.: http://localhost:8000 ; and remove it (change it to empty string)
    // e.g.: it reduces http://localhost:8000/inbound/goods-receive ==> /inbound/goods-receive
    return this.href.replace(/.*\/\/[^\/]*/, '') == addressBarUrl;
})

if (activePage) {
    activePage.addClass('active text-white bg-blue')
    activePage.parents('li.has-treeview').addClass('menu-open')
}
