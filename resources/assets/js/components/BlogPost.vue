<template>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div>
                    <h2 class="post-title">{{post.title}}</h2>
                    <span v-if="user && user.id == post.user.id" class="pull-right">
                        <a :href="'/blog/' + post.id" data-method='delete' rel='nofollow' data-confirm='Are you sure?' class='jq-method-override'><span class="fa fa-trash"></span></a>
                    </span>  
                </div>              
                <p>{{post.created_at}} By {{post.user.name}}</p>
            </div>
            <div class="panel-body">
                <div>
                    <p v-html="post.content"></p>
                </div>  
            </div>
        </div>
    <div>
</template>
<script>
    export default {
        props: ['post', 'user']
    }
    
    
</script>
