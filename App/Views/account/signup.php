<h1>Sign Up page</h1>

<form action='/signup' method='post'>
    <p>
        <h3>User name: </h3>
        <input type='text' name='userName' value=<?=$_POST['userName'] ?? ''?>>
    </p>
    <p>
        <h3>Password: </h3>
        <input type='text' name='password' value=<?=$_POST['password'] ?? ''?>>
    </p>
    <p>
        <h3>Repeat password: </h3>
        <input type='text' name='rPassword' value=<?=$_POST['rPassword'] ?? ''?>>
    </p>
    <p>
        <h3>Email: </h3>
        <input type='text' name='email' value=<?=$_POST['email'] ?? ''?>>
    </p>
    <button type="submit"> Sign Up </button>
    <p>
        <h3>
            <?=$_POST['createProcess'] ?? null?>
        </h3>
    </p>
</form>