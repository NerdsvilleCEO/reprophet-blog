<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Blog Entries</div>

                    <div class="panel-body">
                        <div v-if="lv_data.posts.length == 0">Hmm, looks like there aren't any posts... that's, well... boring :(</div>
                        <div v-for="post in lv_data.posts">
                            <div class="list-group">
                                <div class="list-group-item title">
                                    <h3>{{post.title}}</h3>
                                    <p>{{post.created_at}} by {{post.user.name}}</p>
                                </div>
                                <div class="list-group-item content">
                                    <article>{{post.content}}</article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lv_data: lv_data
            }
        },
    }
</script>
