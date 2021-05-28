define([
    'jquery',
    'ko', 
    'mage/url',
    'mage/storage',
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function ($, ko, urlBuilder, storage, uiComponent, customerData){
    'use strict';
    var symbol = ko.observable("");
    function itemChecked(item) {
        var self = this;
        self.product = ko.observable(item);
        self.qty = ko.observable(1);
        self.plus = function () {
            self.qty(self.qty() + 1);
        };
        self.minus = function () {
            if (self.qty() >=2)
            self.qty(self.qty() - 1);
        };
        self.subTotal = ko.computed(function (){
            return (self.qty() * self.product().price);
        });
        
        self.showSub = symbol() + self.subTotal().toFixed(2);
    }

    function viewModel () {
        var self = this;
        self.defaults = {
            template: 'AHT_KnockoutJs/index'
        };
        self.productList = ko.observableArray([]);
        self.getListSearch = function () {
            var key = $('#key-search').val();
            var url = urlBuilder.build('fastorder/fastorder/search?key='+key);

            return storage.get(
                url,
                true
            ).done(function (response){
                var result = JSON.parse(response);
                if (result != null) {
                    result.list = $.map(result.list, function (index){
                        index['isChecked'] = self.checkExistInCheckedList(index);
                        return index;
                    });
                    symbol(result.symbol);
                    self.productList(result.list);
                } else {
                    self.productList([]);
                }
            }).fail(function (response){
                self.productList([]);
            });
        };

        self.checkedList = ko.observableArray([]);
        self.checkExistInCheckedList = function (item) {
            var exist = false;
            ko.utils.arrayFilter(self.checkedList(), function (index) {
                if (index.product().entity_id == item.entity_id) {
                    exist = true;
                } 
            });
            return exist;
        }
        self.changeCheckedList = function () {
            var exist = self.checkExistInCheckedList(this);
            var idThis = this.entity_id;
            if (this.isChecked && !exist) {
                self.checkedList.push(new itemChecked(this));
            } else if (exist && !this.isChecked) {
                var product = null;
                ko.utils.arrayFilter(self.checkedList(), function (index){
                    if (index.product().entity_id == idThis) 
                    product =  index;
                });
                self.checkedList.remove(product);
            }
            console.log(self.checkedList());
        };

        self.line = ko.computed(function (){
            return self.checkedList().length;
        });
        self.totalQty = ko.computed(function () {
            var count = 0;
            ko.utils.arrayFilter(self.checkedList(), function (index){
                count += index.qty();
            });
            return count;
        });
        self.subTotal = ko.computed(function (){
            var count = 0;
            ko.utils.arrayFilter(self.checkedList(), function (index){
                count = index.subTotal() + count;
            });
            return symbol() + count.toFixed(2);
        });

        self.deleteChecked = function () {
            var idDelete = this.product().entity_id;
            var product = null;
            ko.utils.arrayFilter(self.checkedList(), function (index){
                if (index.product().entity_id == idDelete) {
                    index.product().isChecked = false;
                    product = index;
                }
            });
            self.checkedList.remove(product);
            $('#'+this.product().sku).attr('checked', false);
        }

        self.addToCart = function () {
            var url = urlBuilder.build('fastorder/fastorder/addtocart');
            var data = [];

            ko.utils.arrayFilter(self.checkedList(), function (index) {
                data.push({
                    'product': index.product().entity_id,
                    'qty': index.qty()
                })
            });

            var result = storage.post(
                url,
                JSON.stringify(data),
                false
            ).done(function (response, status){
                if (status == 'success') {
                    alert('add cart success');
                    // location.reload();
                    self.checkedList([]);
                    self.productList([]);
                    $("#key-search").val('')
                    customerData.reload(['cart'], true);
                }
            }).fail(function (response) {
                alert('add cart fail');
            });;
        }
    }
    return uiComponent.extend(new viewModel());
    
});