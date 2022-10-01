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
                    </ul>
                    <form action="{{ url('/post_search') }}" method="GET" class="d-flex">
                        @csrf
                        <input style="width:250px;" name="search" type="text" placeholder="名前や投稿キーワードで検索"class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container text-center">

            <h1 style="margin-top: 20px">全ての投稿</h1>
            @foreach ($post as $post)
                <div style="margin-top: 30px;">
                    <div class="card" style="width: 600px; margin: auto;">
                        <img src="/picture/{{ $post->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->postByName }}</h5>
                            <p class="card-text">{{ $post->status }}</p>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="reply(this);">返信する</a>
                            <a class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')"
                                href="{{ url('post_delete', $post->id) }}">削除する</a>
                            <a class="btn btn-secondary" href="{{ url('post_edit_show', $post->id) }}">編集する</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        <div style="display:none; margin-top: 30px" class="replyDiv text-center">
            <textarea name="" style="height: 100px; width: 500px" placeholder="返信しよう"></textarea>
            <br>
            <a href="" class="btn btn-primary" onclick="reply(this);">Reply</a>
            <a href="javascript:void(0);" class="btn btn-primary close" onclick="cancel(this);">やめる</a>
        </div>

        <script type="text/javascript">
            function reply(caller) {
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
