<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @auth
        <div
            style="border: 3px solid black; padding: 20px; display: flex; flex-direction: row; justify-content: space-between; align-items: flex-end;">
            <h1>Logged In</h1>
            <form action="/logout" method="POST">
                @csrf
                <button>Log Out</button>
            </form>
        </div>
        <div style="border: 3px solid black; padding: 20px; margin-top:10px;">
            <h2>Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Title">
                <textarea name="body" placeholder="Body content..."></textarea>
                <button>Post</button>
            </form>
        </div>
        <div style="display: flex; flex-direction: row; gap: 10px; width: 100%;">
            <div style="border: 3px solid black; padding: 20px; margin-top: 10px; flex-grow: 1;">
                <h2>My Post</h2>
                @foreach ($myposts as $item)
                    <div style="background: grey; padding:20px; margin: 10px;">
                        <h3>{{ $item['title'] }} by You</h3>
                        <p>{{ $item['body'] }}</p>
                        <form method="POST" action="/delete/post/{{$item->id}}">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div style="border: 3px solid black; padding: 20px; margin-top: 10px; flex-grow: 1;">
                <h2>All Post</h2>
                @foreach ($posts as $item)
                    <div style="background: grey; padding:20px; margin: 10px;">
                        <h3>{{ $item['title'] }} by {{$item->user->name}}</h3>
                        <p>{{ $item['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div style="display: flex; flex-direction: row; gap:10px">
            <div style="border: 3px solid black; padding: 20px;">
                <h2>Register</h2>
                <form action="/register" method="POST">
                    @csrf
                    <input name="name" type="text" placeholder="Name">
                    <input name="email" type="email" placeholder="Email">
                    <input name="password" type="text" placeholder="Password">
                    <button type="submit">Register</button>
                </form>
            </div>
            <div style="border: 3px solid black; padding: 20px">
                <h2>Login</h2>
                <form action="/login" method="POST">
                    @csrf
                    <input name="loginemail" type="email" placeholder="Email">
                    <input name="loginpassword" type="text" placeholder="Password">
                    <button type="submit">Login</button> <!-- Changed "Register" to "Login" -->
                </form>
            </div>
        </div>
    @endauth
</body>

</html>
