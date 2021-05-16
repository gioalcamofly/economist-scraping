<template>
    <v-main>
        <v-container fluid style="padding: 2em">
            <v-row dense>
                <v-col
                    v-for="article in news"
                    :key="article.title"
                    cols="3"
                >
                    <v-card @click="openArticle(article.link)" class="news-card" >
                        <div class="d-flex flex-no-wrap justify-space-between">
                            <div>
                                <v-card-title class="headline" style="word-break: normal" v-text="article.title" />
                                <v-card-subtitle v-text="article.description" />
                            </div>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
        <v-dialog
            v-model="dialog"
            hide-overlay
            transition="dialog-bottom-transition"
            scrollable
            max-width="1000px"
        >
            <v-card height="100%">
                <v-card-title class="headline">
                    {{ selectedArticle.title }}
                </v-card-title>
                <v-card-subtitle>
                    {{ selectedArticle.description }}
                </v-card-subtitle>

                <p 
                    v-for="paragraph in selectedArticle.body"
                    :key="paragraph"
                    style="padding: 1em"
                >
                    {{ paragraph }}
                </p>

                <v-card-actions>
                    <v-spacer/>
                    <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </v-main>
</template>
<script>

const axios = require('axios').default;

export default {

    props: {
        user: {
            type: String,
            required: true,
        }
    },

    data() {
        return {
            news: [],
            dialog: false,
            selectedArticle: {
                title: null,
            },
            defaultSelectedArticle: {
                title: null,
            }
        }
    },

    watch: {
        dialog (val) {
            if (!val) {
                this.close();
            }
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            
            axios.get('/api/news-list')
                .then(response => {
                    this.news = response.data;
                }).catch(error => {
                    console.log(error);
                });

        },

        openArticle(link) {

            axios.get('/api/article' + link)
                .then(response => {
                    this.selectedArticle = response.data;
                    this.dialog = true;
                }).catch(error => {
                    console.log(error);
                });

        },

        close () {
            this.dialog = false;
            this.selectedArticle = Object.assign({}, this.defaultSelectedArticle);
        },
}


}

</script>

<style scoped>

    .news-card {
        overflow-y: auto; 
        height: 160px
    }
</style>
