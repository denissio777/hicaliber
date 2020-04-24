<template>
<div class="container">
<div class="row justify-content-center">
<div>
    <input class="search__input" type="text" v-model="keywordsPriceFrom" placeholder="Price From">
    <input class="search__input" type="text" v-model="keywordsName" placeholder="Name">
    <input class="search__input" type="text" v-model="keywordsBedrooms" placeholder="Bedrooms">
    <input class="search__input" type="text" v-model="keywordsBathrooms" placeholder="Bathrooms">
    <br/>
    <input class="search__input" type="text" v-model="keywordsPriceTo" placeholder="Price To">
    <input class="search__input" type="text" v-model="keywordsStoreys" placeholder="Storeys">
    <input class="search__input" type="text" v-model="keywordsGarages" placeholder="Garages">
<button class="btn btn-primary" type="button" @click="update" v-if="!is_refresh">Button</button>
<button class="btn btn-primary" type="button" disabled v-if="is_refresh">
<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
Loading...
</button>
</div>
    <br/>
    <div class="row justify-content-center">
<table class="table table-striped" :style="property">
<thead>
<tr>
<th>Name</th>
<th>Price</th>
<th>Bedrooms</th>
<th>Bathrooms</th>
<th>Storeys</th>
<th>Garages</th>
</tr>
</thead>
<tbody>
<tr v-for="user in users">
<td>{{ user.name }}</td>
<td>{{ user.price }}</td>
<td>{{ user.bedrooms }}</td>
<td>{{ user.bathrooms }}</td>
<td>{{ user.storeys }}</td>
<td>{{ user.garages }}</td>
</tr>
</tbody>
</table>
    </div>
</div>
</div>
</template>

<script>
import axios from 'axios';
export default {
data: function(){
return {
    keywordsName: '',
    keywordsPriceFrom: '',
    keywordsPriceTo: '',
    keywordsBedrooms: '',
    keywordsBathrooms: '',
    keywordsStoreys: '',
    keywordsGarages: '',
users: [],
is_refresh: false,
property: 'display: none',
}
},
    watch: {
        keywordsName(after, before) {
            this.FetchData();
        },
        keywordsPriceFrom(after, before) {
            this.FetchData();
        },
        keywordsPriceTo(after, before) {
            this.FetchData();
        },
        keywordsBedrooms(after, before) {
            this.FetchData();
        },
        keywordsBathrooms(after, before) {
            this.FetchData();
        },
        keywordsStoreys(after, before) {
            this.FetchData();
        },
        keywordsGarages(after, before) {
            this.FetchData();
        },
    },
methods: {
update: function () {
this.is_refresh = true;
axios.get('/ajax',{
    params: {
        keywordsName: this.keywordsName,
        keywordsPriceFrom: this.keywordsPriceFrom,
        keywordsPriceTo: this.keywordsPriceTo,
        keywordsBedrooms: this.keywordsBedrooms,
        keywordsBathrooms: this.keywordsBathrooms,
        keywordsStoreys: this.keywordsStoreys,
        keywordsGarages: this.keywordsGarages,
    }
}).then((response) => {
    if (response.data.length != 0) {
        this.property = 'display: block';
    } else {
        this.property = 'display: none';
        alert('Matches not found! :(')
    }
console.log(response.data);
this.users = response.data;
this.is_refresh = false;
});
}
}
}
</script>

