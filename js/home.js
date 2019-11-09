function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function(url) {
        return '<a href="' + url + '">' + url + '</a>';
    })
    // or alternatively
    // return text.replace(urlRegex, '<a href="$1">$1</a>')
}

// var text = "Find me at http://www.example.com and also at http://stackoverflow.com";
// var html = urlify(text);

$(document).ready(() => {

	let element = document.getElementById("public-chats");
    element.scrollTop = element.scrollHeight;


 //    setInterval(function() {
	// 	console.log('RELOAD!!');
	// 	$("#public-chats").load("getChats.php");
	// 	// $.ajax({
	// 	//   url: "./getChats.php",
	// 	//   dataType: 'html',
	// 	//   success: function(html) {
	// 	//     console.log("Success Loading!");
	// 	//   }
	// 	// });
	// }, 1500);

	// $('#placeorder').click(function() {
	//     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	//       var target = $(this.hash);
	//       target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	//       if (target.length) {
	//         $('html,body').animate({
	//           scrollTop: target.offset().top
	//         }, 1000);
	//         return false;
	//       }
	//     }
	// });

});
