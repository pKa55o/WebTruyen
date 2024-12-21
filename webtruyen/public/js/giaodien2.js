document.addEventListener('DOMContentLoaded', function () {
    const commentInput = document.getElementById('comment-input');
  
    // Gán sự kiện click cho các emoji
    document.querySelectorAll('.emoji').forEach((emoji) => {
      emoji.addEventListener('click', () => {
        const emojiChar = emoji.textContent;
  
        // Lấy vị trí con trỏ trong textarea
        const startPos = commentInput.selectionStart;
        const endPos = commentInput.selectionEnd;
  
        // Chèn emoji vào vị trí con trỏ
        const textBefore = commentInput.value.substring(0, startPos);
        const textAfter = commentInput.value.substring(endPos, commentInput.value.length);
        commentInput.value = textBefore + emojiChar + textAfter;
  
        // Đặt lại con trỏ sau emoji
        commentInput.selectionStart = commentInput.selectionEnd = startPos + emojiChar.length;
  
        // Focus lại textarea
        commentInput.focus();
      });
    });
  
    // Xử lý khi gửi bình luận
    document.getElementById('submit-comment').addEventListener('click', () => {
      const commentText = commentInput.value.trim();
      const defaultUsername = 'Kha Ni';
      const defaultAvatar = '/imgs/avtcmt.jpg';
  
      if (commentText) {
        const commentContainer = document.getElementById('comments-container');
  
        // Tạo phần tử hiển thị bình luận
        const commentItem = document.createElement('li');
        commentItem.innerHTML = `
          <div class="comment-avatar">
            <img src="${defaultAvatar}" alt="Avatar">
          </div>
          <div class="comment-content">
            <strong>${defaultUsername}</strong>
            <p>${commentText}</p>
          </div>
        `;
  
        // Thêm bình luận vào danh sách
        commentContainer.prepend(commentItem);
  
        // Xóa nội dung trong ô nhập
        commentInput.value = '';
      } else {
        alert('Vui lòng nhập nội dung bình luận.');
      }
    });
  });
  