function search() {
	zipcode = document.getElementById("zip");
	window.open("/prefselect.php?zipcode=" + zipcode.value, null, "width=320,height=240,scrollbars=yes,menubar=no,toolbar=no,location=no,status=no,dialog=yes");
}
