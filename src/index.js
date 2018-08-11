var box = document.getElementById("light-slider").getElementsByTagName("div").item(1);
document.getElementById("light").addEventListener(
	"input",
	function(e) {
		var bg = Math.round(255 * parseInt(this.value, 10) / 100);
		var fg = 255 - bg;
		box.style.color = fg < 96 ||
			fg > 160 ?
			"rgb(" + fg + ", " + fg + ", " + fg + ")" :
			"inherit";
		box.style.backgroundColor = "rgb(" + bg + ", " + bg + ", " + bg + ")";
		box.firstChild.nodeValue = this.value + "%";
	}
);
