<h1>Log In page</h1>

<form action='/login' method='post'>
    <p>
        <h3>User name: </h3>
        <input type='text' name='loginName' value=<?=$_POST['loginName'] ?? ''?>>
    </p>
    <p>
        <h3>Password: </h3>
        <input type='text' name='loginPassword' value=<?=$_POST['loginPassword'] ?? ''?>>
    </p>
    <button type="submit"> Log In </button>
    <p>
        <h3>
            <?=$_POST['loginProcess'] ?? null?>
        </h3>
    </p> 
</form>