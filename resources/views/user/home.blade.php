<x-app-layout>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="home/css/style.css">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ url('/my_post_list') }}">あなたの投稿一覧を見る</a>
                          </li>
                    </ul>
                    <form action="{{ url('/post_search') }}" method="GET" class="d-flex">
                        @csrf
                        <input name="search" type="text" class="form-control me-2" type="search" placeholder="名前や投稿キーワード">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container text-center">
            <form action="{{ url('/post_message') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea style="width:500px; height:200px;" name="message" placeholder="メッセージを自由に投稿しましょう"></textarea>
                <br>
                ※必須<input name="image" class="btn btn-primary"type="file">
                <button type="submit" class="btn btn-secondary">送信する</button>
            </form>


            <h1 style="margin-top: 20px">全ての投稿</h1>
            @foreach ($post as $post)
                <div style="margin-top: 30px;">
                    <div class="card" style="width: 600px; margin: auto;">
                        <img src="/picture/{{ $post->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->postByName }}</h5>
                            <p class="card-text">{{ $post->status }}</p>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="reply(this)" data-postid="{{ $post->id }}">返信する</a>
                            @if($post->postBy == $user_id)
                            <a class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')"
                                href="{{ url('post_delete', $post->id) }}">削除する</a>
                            <a class="btn btn-secondary" href="{{ url('post_edit_show', $post->id) }}">編集する</a>
                            @endif
                        </div>
                        @foreach($reply as $replys)
                        @if($replys->message_id == $post->id)
                        <div style="padding-Left: 3%; padding_bottom: 10px; padding_bottom: 10px;">
                            <b>{{ $replys->name }}</b>
                            <p>{{ $replys->reply }}</p>
                            <a style="color: blue"href="javascript::void(0)" onclick="reply(this)" data-postid="{{ $post->id }}">返信する</a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>




        <div style="display:none; margin-top: 30px" class="replyDiv text-center">
            <form action="{{ url('post_reply') }}" method="POST">
                @csrf
                <input type="text" id="replyId" name="replyId" hidden="">
                <textarea name="reply" style="height: 100px; width: 500px" placeholder="返信しよう"></textarea>
                <br>
                <button type="submit"  class="btn btn-primary" onclick="reply(this);">Reply</button>
                <a href="javascript:void(0);" class="btn btn-primary close" onclick="cancel(this);">やめる</a>
            </form>
        </div>

        <script type="text/javascript">
            function reply(caller) {

                document.getElementById('replyId').value = $(caller).attr('data-postid');

                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }

            function cancel(caller) {
                $('.replyDiv').hide();
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>

</x-app-layout>
