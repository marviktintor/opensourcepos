var assert = require('assert');
var ospos = require('./ospos');

describe("create item", function () {

    it("should be able to add new item", function (done) {
        return this.browser.get(ospos.url("/index.php/items")).waitForElement("a[title='New Item']", 5000).click()
            .waitForElementByName("name", 10000).type("anItem").elementById('cost_price', 2000).clear().type("10").elementById("unit_price", 2000).type("20")
            .elementById('tax_name_1', 2000).type('VAT').elementById("tax_percent_name_1", 2000).type("21")
            .elementById("1_quantity", 2000).type("1").elementById("reorder_level", 2000).type("0").elementById("submit", 2000).click();
    });

});