export default {
  el: '#call-filter',
  data: {
    filter: '',
    first_name: '',
    last_name: '',
    phone_1: '',
    phone_2: '',
    business: '',
    email_1: '',
    email_2: '',
    reference: ''
  },
  computed: {},
  methods: {},
  created: function () {
    const filterBy = document.getElementById('filter_by')
    this.filter = filterBy[filterBy.selectedIndex].value

    switch (this.filter) {
      case 'first_name':
        const firstName = document.getElementById('first_name').value
        this.first_name = firstName
        break
      case 'last_name':
        const lastName = document.getElementById('last_name').value
        this.last_name = lastName
        break
      case 'phone_1':
        const phone1 = document.getElementById('phone_1').value
        this.phone_1 = phone1
        break
      case 'phone_2':
        const phone2 = document.getElementById('phone_2').value
        this.phone_2 = phone2
        break
      case 'business':
        const business = document.getElementById('business').value
        this.business = business
        break
      case 'email_1':
        const email1 = document.getElementById('email_1').value
        this.email_1 = email1
        break
      case 'email_2':
        const email2 = document.getElementById('email_2').value
        this.email_2 = email2
        break
      case 'reference':
        const reference = document.getElementById('reference').value
        this.reference = reference
        break
      default:
        break
    }
  },
  mounted: function () {}
}
