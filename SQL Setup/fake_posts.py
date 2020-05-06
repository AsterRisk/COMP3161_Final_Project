import sys

if __name__ == "__main__":
	fptr = open("numPosts.txt", "r")
	numPosts = int(fptr.readlines()[0])
	fptr.close()
	fptr2 = open("fake_posts.sql", "w")
	numNewPosts = int(sys.argv[1])
	for x in range(1, numNewPosts, 2):
		sql = "insert into posts (user_id, post_id, text_content) values (" + str(x) + ", " + str(numPosts+x) + ", 'Lorem ipsum....');\n"
		fptr2.write(sql)
		sql = "insert into posts (user_id, post_id, text_content) values (" + str(x) + ", " + str(numPosts+x+1) + ", '...dolor sit amet....');\n"
		fptr2.write(sql)
	newPosts = str(numPosts+numNewPosts)
	print(newPosts)
	fptr = open("numPosts.txt", "w")
	fptr.write(newPosts)
	fptr.close()
	fptr2.close()