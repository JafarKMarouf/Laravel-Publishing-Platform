@props(['user'])
<div
    {{$attributes}}
    x-data="{
    isFollowing: {{auth()->check() && $user->isFollowedBy(auth()->user()->id) ?'true':'false'}},
    followersCount : {{$user->followers()->count()}},
    follow(){
        axios.post('/follow/{{$user->id}}')
            .then(res => {
                this.followersCount = res.data.followersCount;
                console.log(res.data.followersCount);
            }).catch(err => {
                console.log(err);
            });
        this.isFollowing = !this.isFollowing;
    }
}">
    {{$slot}}
</div>
