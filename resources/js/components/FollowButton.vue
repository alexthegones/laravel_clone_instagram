<template>
    <div>
        <button class="btn btn-primary" @click="followProfile" v-text="following"></button>
    </div>
</template>

<script>
    export default {

        props: ['profileId', 'follow'],// * Propriétés immutable

        data: function () {
            return {
                status: this.follow
            }
        },
        methods: {
            followProfile()
            {
                axios.post('/follow/' + this.profileId)// * Requête HTTP via Axios
                .then(response => {
                   this.status =! this.status;
                })
                .catch(errors => {
                    if(errors.response.status === 401){
                        window.location = '/login';
                    }
                })
            }
        },
        computed: { // * Valeur calculée (v-text)
            following(){
                // * Si follow c-a-d le statue, est true ou non
                return(this.status) ? 'Suivre' : 'Ne plus suivre';
            }
        }
    }
</script>
