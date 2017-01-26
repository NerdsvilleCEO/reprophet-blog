<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Blog Entries</div>

                    <div class="panel-body">
                        <div v-if="posts.length == 0">Hmm, looks like there aren't any posts... that's, well... boring :(</div>
                        <div v-for="post in posts">
                            <div class="list-group">
                                <div class="list-group-item title">
                                    <div>
                                        <a :href="'/blog/' + post.id"><h3 class="post-title">{{post.title}}</h3></a>                    
                                        <span v-if="user && user.id == post.user.id" class="pull-right">

                                            <a :href="'/blog/' + post.id + '/edit'"><span class="fa fa-edit"></span></a>
                                            <a :href="'/blog/' + post.id" data-method='delete' rel='nofollow' data-confirm='Are you sure?' class='jq-method-override'><span class="fa fa-trash"></span></a>
                                        </span>  
                                    </div>
                                    <p>{{post.created_at}} by {{post.user.name}}</p>
                                </div>
                                <div class="list-group-item content">
                                    <article v-html="post.content"></article>
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
        props: ['posts', 'user']
    }
</script>
