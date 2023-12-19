// This script is for the correct paddings on the a-elements in #navigation
function calculateBlogImage(blogDiv, blogImage){
	var fullHeight =  $(blogDiv).height();
	$(blogImage).css('height', fullHeight);
}