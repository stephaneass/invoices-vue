<template>
    <div class="container">
        <!--==================== NEW INVOICE ====================-->
        <div class="invoices">
            
            <div class="card__header">
                <div>
                    <h2 class="invoice__title">New Invoice</h2>
                </div>
                <div>
                    
                </div>
            </div>

            <div class="card__content">
                <div class="card__content--header">
                    <div>
                        <p class="my-1">Customer</p>
                        <select name="" id="" class="input" v-model="customer_id">
                            <option value="" disabled>Select customer</option>
                            <option :value="customer.id" v-for="customer in allcustomers" :key="customer.id">
                                {{customer.first_name}}
                            </option>
                        </select>
                    </div>
                    <div>
                        <p class="my-1">Date</p> 
                        <input id="date" placeholder="dd-mm-yyyy" type="date" class="input" v-model="form.date"> <!---->
                        <p class="my-1">Due Date</p> 
                        <input id="due_date" type="date" class="input" v-model="form.due_date">
                    </div>
                    <div>
                        <p class="my-1">Numero</p> 
                        <input type="text" class="input" v-model="form.number"> 
                        <p class="my-1">Reference(Optional)</p> 
                        <input type="text" class="input" v-model="form.reference">
                    </div>
                </div>
                <br><br>
                <div class="table">

                    <div class="table--heading2">
                        <p>Item Description</p>
                        <p>Unit Price</p>
                        <p>Qty</p>
                        <p>Total</p>
                        <p></p>
                    </div>
        
                    <!-- item 1 -->
                    <div class="table--items2" v-for="(item, i) in listCard" :key="item.id">
                        <p>#{{item.item_code}} {{item.description}} </p>
                        <p>
                            <input type="text" class="input" v-model="item.unit_price">
                        </p>
                        <p>
                            <input type="text" class="input" v-model="item.quantity">
                        </p>
                        <p v-if="item.quantity">
                            $ {{(item.quantity * item.unit_price)}}
                        </p>
                        <p v-else></p>
                        <p style="color: red; font-size: 24px;cursor: pointer;" @click="removeItem(i)">
                            &times;
                        </p>
                    </div>
                    <div style="padding: 10px 30px !important;">
                        <button class="btn btn-sm btn__open--modal" @click="openModal()">
                            Add New Line
                        </button>
                    </div>
                </div>

                <div class="table__footer">
                    <div class="document-footer" >
                        <p>Terms and Conditions</p>
                        <textarea cols="50" rows="7" class="textarea" v-model="form.terms_and_conditions"></textarea>
                    </div>
                    <div>
                        <div class="table__footer--subtotal">
                            <p>Sub Total</p>
                            <span>$ {{subTotal()}}</span>
                        </div>
                        <div class="table__footer--discount">
                            <p>Discount</p>
                            <input type="text" class="input" v-model="form.discount">
                        </div>
                        <div class="table__footer--total">
                            <p>Grand Total</p>
                            <span>$ {{total()}}</span>
                        </div>
                    </div>
                </div>

            
            </div>
            <div class="card__header" style="margin-top: 40px;">
                <div>
                    
                </div>
                <div>
                    <a class="btn btn-secondary" @click="saveCard()">
                        Save
                    </a>
                </div>
            </div>
            
        </div>
        <!--==================== add modal items ====================-->
        <div class="modal main__modal " :class="{show : showModal}">
            <div class="modal__content">
                <span class="modal__close btn__close--modal" @click="closeModal()">×</span>
                <h3 class="modal__title">Add Item</h3>
                <hr><br>
                <div class="modal__items">
                    <!-- <select class="input my-1">
                        <option value="None">None</option>
                        <option value="None">LBC Padala</option>
                    </select> -->
                    <ul style="list-style: none;">
                        <li v-for="(item, i) in listProducts" :key="item.id" style="display:grid; grid-template-columns:30px 350px 15px; align-items:center; padding-bottom:5px;">
                            <p>{{i+1}}</p>
                            <a href="#">{{item.item_code}} {{item.description}}</a>
                            <button @click="addToCard(item)" style="border:1px solid #e0e0e0; width:35px; heigth:35px; cursor:pointer;">
                                +
                            </button>
                        </li>
                    </ul>
                </div>
                <br><hr>
                <div class="model__footer">
                    <button class="btn btn-light mr-2 btn__close--modal" @click="closeModal()">
                        Cancel
                    </button>
                    <button class="btn btn-light btn__close--modal ">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {onMounted, ref} from 'vue'
    import { useRouter } from 'vue-router'

    const router = useRouter()

    let form = ref([])
    let allcustomers = ref([])
    let customer_id = ref([])
    let item = ref([])
    let listCard = ref([])
    const showModal = ref(false)
    const hideModal = ref(true)

    let listProducts = ref([])

    onMounted(async () => {
        indexForm()
        getAllCustomers()
        getProducts()
    })

    const indexForm = async() => {
        let response = await axios.get('/api/create_invoice')

        console.log('form', response.data);
        form.value =  response.data
    }

    const getAllCustomers = async () => {
        let response = await axios.get('/api/customers')
        //console.log('customers : ', response.data.customers);
        allcustomers.value = response.data.customers
    }

    const addToCard = (item) => {
        const item_card = {
            id: item.id,
            item_code: item.item_code,
            description: item.description,
            unit_price: item.unit_price,
            quantity: item.quantity,
        }
        listCard.value.push(item_card)

        closeModal()
    }

    const openModal = () => {
        showModal.value = !showModal.value
    }

    const closeModal = () => {
        showModal.value = !hideModal.value
    }

    const getProducts = async () => {
        let response = await axios.get('/api/products')
        console.log(response.data.products);

        listProducts.value = response.data.products
    }

    const removeItem = (i) => {
        listCard.value.splice(i, 1)
    }

    const subTotal = () => {
        let total = 0
        listCard.value.map((item)=>{
            total += (item.quantity * item.unit_price)
        })
        return total
    }

    const total = () => {
        return subTotal( ) - form.value.discount
    }

    const saveCard = () => {

        if (listCard.value.length >= 1) {
            let sub_total = 0
            sub_total = subTotal()
    
            let _total = 0
            _total = total()
    
            const formData = new FormData()
            formData.append('invoice_items', JSON.stringify(listCard.value))
            formData.append('customer_id', customer_id.value)   
            formData.append('date', form.value.date)   
            formData.append('due_date', form.value.due_date)   
            formData.append('number', form.value.number)   
            formData.append('reference', form.value.reference)   
            formData.append('discount', form.value.discount)   
            formData.append('sub_total', sub_total)   
            formData.append('total', _total)   
            formData.append('terms_and_conditions', form.value.terms_and_conditions)   

            axios.post('/api/products/store', formData)
            listCard.value = []
            router.push('/')
        }
    }
</script>