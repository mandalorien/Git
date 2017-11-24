/**
 *
 * Copyright (c) 2015-Present, mandalorien
 * All rights reserved.
 *
 * create 2015 by mandalorien
 */
$(document).ready(function()
{
	// Assign handlers immediately after making the request,
	// and remember the jqxhr object for this request
	var listBranches = $.get("https://api.github.com/repos/kiwille/uniguerre/branches", function(data) {
	})
	  .done(function(data) {
		$(data).each(function() {
			if(this.name == 'master' || this.name =='dev')
			{
				var branch = this.name;
				var SBranch = $.get("https://api.github.com/repos/kiwille/uniguerre/branches/"+ branch, function(data2) {
				})
				  .done(function(data2) {
					console.log(data2.commit.commit.committer);
				  })
				  .fail(function() {
					alert( "error" );
				  });
			}
		});
	  })
	  .fail(function() {
		alert( "error" );
	  });
});