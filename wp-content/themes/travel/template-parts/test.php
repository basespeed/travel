<?php
/*
    Template Name: test
*/

?>
<!--
<button id="request">request</button>
<button id="click">click</button>

<script>
    let dnperm = document.getElementById('request');
    let dntrigger = document.getElementById('click');

    dnperm.addEventListener('click', function(e){
        e.preventDefault();

        if(!window.Notification){
            alert("Notification not supported!");
        }else{
            Notification.requestPermission().then(function(permission) {
                console.log(permission);
                if(permission === 'denied'){
                    alert('You Have Denied Notification!');
                }else if(permission === 'granted'){
                    alert('You Have Granted notification.');
                }
            })
        }
    });

    // simulate

    dntrigger.addEventListener('click', function(e){
        let notify;

        e.preventDefault();

        console.log(Notification.permission);

        if(Notification.permission === 'default'){
            alert('Please allow notification before doing this');
        }else {
            notify = new Notification('New Message From Romzik', {
                body: 'How are you today? Is it really is a lovely day.',
                icon: 'https://wikicachlam.com/wp-content/uploads/2018/05/tong-hop-nhung-hinh-anh-dep-nhat-cua-bo-cong-anh-30.jpeg',
                image: 'https://st.quantrimang.com/photos/image/2017/11/07/anh-dep-viet-nam-1.jpg',
            });

            notify.onclick = function (ev) {
                console.log(this);
                window.location = 'https://192.168.2.61/travel';
            }
        }
    })
</script>
-->


<?php
get_header();

?>
<h1>saddsaads</h1>
<h1>saddsaads</h1>
<h1>saddsaads</h1>
    <form class="frm_sheet" method="post">
        <input type="text" name="name" placeholder="Name"/>
        <input type="text" name="phone" placeholder="Phone"/>
        <input type="text" name="local" placeholder="Local"/>
        <button type="submit"id="submit-form">Gửi</button>
    </form>
<?php

get_footer();