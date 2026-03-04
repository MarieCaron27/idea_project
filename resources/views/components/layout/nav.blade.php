<nav class="border-b border-border px-6">
    <div class="max-w-7x1 mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/">
                <img src="/images/logo.jpg" alt="Idea logo" width="60"/>
            </a>
        </div>

        <div class="flex gap-x-5 items-center"> 
            @auth
                <form action="/logout" method="post">
                    @csrf

                    <button>Log out</button>
                </form>
            @endauth
            
            @guest
                <a href="/auth/register" class="btn">Register</a>
                <a href="/auth/login">Log In</a>
            @endguest
        </div>
    </div>
</nav>
