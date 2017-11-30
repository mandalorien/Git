/**
 *
 * Copyright (c) 2015-Present, mandalorien
 * All rights reserved.
 *
 * create 2015 by mandalorien
 */

// configuration de base
var gitconfig = {
    Author:"kiwille",
    Repository:"uniguerre",
	listBranchFocus:[
		"master",
		"dev"
	],
	limit:0,
	remaining:0
};

$(document).ready(function()
{
	$("#searchRepository").hide(); 
	$('#canvasloader-container').hide();
	var cl = new CanvasLoader('canvasloader-container');
		cl.setColor('#2970db');
		cl.setShape('sqare');
		cl.setDiameter(67);
		cl.setDensity(20);
		cl.setRange(1);
		cl.setSpeed(1);
		cl.setFPS(25);
		cl.show();
		
	$("#searchRepository").keyup(function() {
		console.log($( "#searchRepository" ).val());
		gitconfig.Repository = $("#searchRepository").val();
		
		if($("#searchRepository").val().isAlphaNumeric()){
			// Search();
		}
	});
	
	RepositoryFocus();
});

function RepositoryFocus(){
	$.get("https://api.github.com/rate_limit", function(rates) {
	})
	.done(function(rates) {
		
		gitconfig.limit = rates.rate.limit;
		gitconfig.remaining = rates.rate.remaining;
		
		Message("Vous avez utilisé "+ (gitconfig.limit - gitconfig.remaining) +" fois l'API V3 Github , vous pouvez encore l'utiliser " + gitconfig.remaining + ".");
		
		var listBranches = $.get("https://api.github.com/repos/"+ gitconfig.Author +"/"+ gitconfig.Repository +"/branches", function(data) {
		})
		.done(function(data) {
			$(data).each(function() {
				for(var i = 0;i <= gitconfig.listBranchFocus.length - 1;i++){
					if(gitconfig.listBranchFocus[i] == this.name){
						var branch = this.name;
						var SBranch = $.get("https://api.github.com/repos/"+ gitconfig.Author +"/"+ gitconfig.Repository +"/branches/"+ branch, function(infos) {
						})
						.done(function(infos) {
							console.log(infos.commit.commit.committer);
						})
						.fail(function() {
							Message(data.responseJSON.message,true);
						});
					}
				}
			});
		})
		.fail(function(data) {
			Message(data.responseJSON.message,true);
		});
	});
}

function Search(){
	
	// rate is limit of use API V3 github , you have to be connected
	// https://api.github.com/rate_limit
	
	var listBranches = $.get("https://api.github.com/search/repositories?q="+ gitconfig.Repository, function(data) {
	})
	.done(function(data) {
		gitconfig.Repository = data.items[0].name;
		console.log(gitconfig.Repository);
		$("#message").hide();
	})
	.fail(function(data) {
		Message(data.responseJSON.message);
	});
}

function Message(msg,error){
	console.log(msg);
	console.log(error);
	$.post(getBaseURL()+"/ajax/index.php", {message:msg,error:error}, function(data) {
			$('#canvasloader-container').show();
	})
	.done(function(data){
		$('#canvasloader-container').show();
		if(data.errors != 0){
			$('#canvasloader-container').hide();
			$("#message").show();
			$("#message").html(data.message);
		}else{
			$('#canvasloader-container').hide();
			$("#message").show();
			$("#message").html(data.message);
		}
	})
	.fail(function() {
		$('#canvasloader-container').show();
		console.log( "error" );
	});
}

String.prototype.isAlphaNumeric = function() {
  var regExp = /^[A-Za-z0-9]+$/;
  return (this.match(regExp));
};