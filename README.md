function login :http://127.0.0.1:8000/api/login/

  + Header Cần truyền:
  
    - Key: Accept -------- Value: application/json
    
    - Key: value  -------- Value: application/json
    
  + Body:
  
  	- email,password
	
  + Đăng nhập lỗi sẽ trả ra json: 
  
    {
    
        "message": "Unauthenticated."
	
    }
  + Đăng nhập thành công sẽ trả json: (ví dụ)
	
    {
		
    "success": {
		
        "token":        "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNjZjN2Q5MmUxZDMxODdjNDQ3YzVjZDI2YjJhMzc1Njg5NThhNTU4Mjc4ZjUyOTFlNDllMzFiMTQ0NWYyZmE0MWUzZjEwMmIyNDYwYmY4MGIiLCJpYXQiOjE1ODYzMzEyMjAsIm5iZiI6MTU4NjMzMTIyMCwiZXhwIjoxNjE3ODY3MjIwLCJzdWIiOiIxNiIsInNjb3BlcyI6W119.NTXCnTzcbPATJqIHYPqWHVKpbRQVJqFA8CRDstMZ6coB4PLpk456fT3vTTn7v0LBB53pSdjVP9y9GKi0XZ5_CmQoz2zBxrX0LNwm28c1GPcc73G-c6T6KZMkCrmwoGOGwMBfeAjAssw5cd-aJHrtQXFb2ydy7z-H4j1u0My8PqGMMkcGvGsCKdURKCBV9L4p3lW0dMVRBk3I1gGtnKlGIeXSdDDjpTITR2VfpZSedioJsmjgAGhM69eIrfiC9pFKUcrGqCgbYvjfB-H0vg3jSmmK5cz6fLJ0odjox3uU7GozbEOJCkcpQ71XQuEK-cFFg7YuFM_l8EpehscXL_y27ePIbWVD-gNXCE0LH5AdiXBAJlVbDU-Mk0TqXSsl-UcObHoV-v_BOFx10GbrEw4H4UQYNscthmU_AyyXlkEo003vzBi2X-FYcNDLF-JECiv9IQHRqiqNa2rFgeDyZ_8Y5-ipJO4wezhWdeEmOd-lNI32A50H19Qb5arw6jJS_KFtBM9pet3uzwhwRWisNqvD-Z9mRYXu8UFbimYoerzggCz83uqgvBNwDY42SzC9T1Jmz0IwG7rapE8DUwEGEOAy38ymYJgbcZhqRz4rD8Nt5BMTbgDwVXuY4UjbiPIh4u-j3lWJ0Q1wXxjzxSPwvEoc8pJKk7WOBg7vjZ01nJRcDRY"
				}
    }
		
Những Function cần đăng nhập mới có thể gọi:

  + Header Cần truyền: 
	
    - Key: Authorization    ----  Value: Bearer + token(sau khi đăng nhập sẽ có)
		
Đội bóng:

	+ Chi tiết đội: http://127.0.0.1:8000/api/chitietdoibong/{id} (GET)
	
	+ Tạo đội bóng mới: 	http://127.0.0.1:8000/api/doibong/ (POST)
	
		- Header Cần truyền:
		
		    * Key: Accept -------- Value: application/json
				
		    * Key: value  -------- Value: application/json
				
		    * Key: Authorization - Value: Bearer + token(sau khi đăng nhập sẽ có)
				
		- Body cần truyền: 
		
		    * ten,trinhdo,user_id 
				
	+ Xin vào đội: 		http://127.0.0.1:8000/api/thanhvien/ (POST)
	
		- Header Cần truyền:
		
		    * Key: Accept -------- Value: application/json
				
		    * Key: value  -------- Value: application/json
				
		    * Key: Authorization - Value: Bearer + token(sau khi đăng nhập sẽ có)
				
		- Body cần truyền: 
		
		    * doibong_id,user_id
	+ Xác nhận người vào đội: http://127.0.0.1:8000/api/thanhvien/id(bản ghi)  (PUT/PATCH)
	
	+ Kick thành viên: http://127.0.0.1:8000/api/thanhvien/id(bản ghi)  (DELETE)
	
	+ Danh sách xin vào đội: http://127.0.0.1:8000/api/doibong/{id} (GET)
	
	+ Danh sách thành viên: http://127.0.0.1:8000/api/danhsachthanhvien/{id} (GET)

