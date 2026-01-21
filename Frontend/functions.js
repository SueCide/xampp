async function get_users() {
    
    const res1 = await fetch("../api/get_usernames.php");
    const users = await res1.json();
    console.log(users)
    
    return (users)
}



export async function checkUser(name) {
    
    const users = await get_users()
    const exist = users.some(user => user.username === name);
    console.log(exist);

    return (exist)
}



export async function create_a_guy(name,pass1) {

    const data_exp = {

        username: name,
        password: pass1

    };

    const res = await fetch("../api/create_a_guy.php",{

        method: "POST",
        headers:{

            "Content-Type": "application/json"

        },

        body: JSON.stringify(data_exp)

    });

    const data_rec = await res.json();
    console.log(data_rec)
    return data_rec
}



export async function check_data(name,pass) {
    
    const data_exp = {

        username: name,
        password: pass

    };

    const res = await fetch("../api/login_check.php",{

        method: "POST",
        credentials:"same-origin",
        headers:{

            "Content-Type": "application/json"

        },

        body: JSON.stringify(data_exp)

    });

    const data_rec = await res.json();
    return data_rec

}

export async function logout() {

   const res = await fetch("../api/delete_session.php",{

        method: "POST",
        credentials:"same-origin"

    });
    const resp = await res.json();
    console.log(resp)
    return undefined;

}