var modelAction = new Vue({
  el: '#modelAction',
  data: {
    action: '0'
  },
  methods: {
    changeType: function (event) {
        modelTransactionCategory.action = modelAction.action
        modelTransactionCategory.transaction_category = '0'
    }
  }

})

var modelPayment = new Vue({
  el: '#modelPayment',
  data: {
    payment: '0'
  },
  methods: {
    changePayment: function (event) {
        modelTransactionCategory.payment = modelPayment.payment
        modelTransactionCategory.transaction_category = '0'
    }
  }
})

var modelTransactionCategory = new Vue({
  el: '#modelTransactionCategory',
  data: {
    transaction_category: '0',
    action: null,
    payment: null
  }
})