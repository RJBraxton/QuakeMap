var initiate = false;

function loadModal(){
	$("#helpModal").modal("show");
}

function animToggle(){
	if(animationOn == true){
		animationOn = false;
		d3.select(".anim")
		.text("Off");
		d3.select(".animbtn")
		.classed("btn-inverse", true);
		if(grassOnTheField == true){
			d3.selectAll('.quakeAnim').remove();
			clearInterval(quakeanim);
			console.log("Animation off.");
		}			
	}
	else {
		animationOn = true;
		d3.select(".anim")
		.text("On");
		d3.select(".animbtn")
		.classed("btn-inverse", false);
		if(grassOnTheField == true){
			quakeAnimate();
			console.log("Animation on.");
		}
	}
}

function mainButton(){
	if(grassOnTheField == true){
		removeQuakes();
		quakeMake(days,sortBy,minMag,limit);
		console.log('Main button pushed, there are quakes being mapped. Removing and replacing.');
		
	}
	else{
		console.log('Main button pushed for the VERY FIRST TIME');
		d3.select(".main")
		.text('Reload')
		.classed("btn-success", false)
		.classed("btn-warning", true);
		quakeMake(days,sortBy,minMag,limit);
	}
}

function presets(input){
	if(input == "today"){
		i_sort("magnitude");
		i_limit("all");
		i_time("1");
		i_mag("all");
		mainButton();
	}
	if(input == "recent10"){
		i_sort("time");
		i_limit("10");
		i_time("1");
		i_mag("4.5");
		mainButton();
	}
	if(input == "biggest"){
		i_sort("magnitude");
		i_limit("5");
		i_time("365");
		i_mag("sig");
		mainButton();
	}
	if(input == "minor"){
		i_sort("time");
		i_limit("100");
		i_time("1");
		i_mag("minor");
		mainButton();
	}
}



function i_time(input){
	days = input;
	
	if(input == '1'){
		d3.select(".i_time")
		.text("1 Day");
	}
	if(input == '2'){
		d3.select(".i_time")
		.text("2 Days");
	}
	if(input == '3'){
		d3.select(".i_time")
		.text("3 Days");
	}
	if(input == '7'){
		d3.select(".i_time")
		.text("Week");
	}
	if(input == '30'){
		d3.select(".i_time")
		.text("Month");
	}
	if(input == '365'){
		d3.select(".i_time")
		.text("Year");
	}
}	

function i_mag(input){
	
	if(input == '2.0'){
		minMag = input;
		maxMag = 10.0;
		d3.select(".i_mag")
		.text("Magnitude 2.0+");
	}
	if(input == '4.5'){
		minMag = input;
		maxMag = 10.0;
		d3.select(".i_mag")
		.text("Magnitude 4.5+");
	}
	if(input == '6.0'){
		minMag = input;
		maxMag = 10.0;
		d3.select(".i_mag")
		.text("Magnitude 6.0+");
	}
	if(input == 'all'){
		minMag = -1.0;
		maxMag = 10.0;
		d3.select(".i_mag")
		.text("All");
	}
	if(input == 'minor'){
		minMag = -1.0;
		maxMag = 2.5;
		d3.select(".i_mag")
		.text("Minor Only");
	}
	if(input == 'sig'){
		minMag = 6.0;
		maxMag = 10.0;
		d3.select(".i_mag")
		.text("Significant Only");
	}
}	