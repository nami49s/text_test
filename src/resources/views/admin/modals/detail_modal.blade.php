<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>モーダルページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
<body>
    <!-- 詳細モーダル -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">詳細情報</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <p><strong>お名前:</strong> <span id="modalFirstName"></span> <span id="modalLastName"></span></p>
                <p><strong>性別:</strong> <span id="modalGender"></span></p>
                <p><strong>メールアドレス:</strong> <span id="modalEmail"></span></p>
                <p><strong>電話番号:</strong> <span id="modalTel1"></span> <span id="modalTel2"></span> <span id="modalTel3"></span></p>
                <p><strong>住所:</strong> <span id="modalAddress"></span></p>
                <p><strong>建物名:</strong> <span id="modalBuilding"></span></p>
                <p><strong>お問い合わせの種類:</strong> <span id="modalCategoryId"></span></p>
                <p><strong>お問い合せ内容:</strong> <span id="modalTextarea"></span></p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".detail-btn").forEach(button => {
        button.addEventListener("click", function() {
            // 削除するデータの ID を取得
            const contactId = this.getAttribute("data-id");
            const firstName = this.getAttribute("data-first_name");
            const lastName = this.getAttribute("data-last_name");
            const gender = this.getAttribute("data-gender");
            const email = this.getAttribute("data-email");
            const tel1 = this.getAttribute("data-tel1");
            const tel2 = this.getAttribute("data-tel2");
            const tel3 = this.getAttribute("data-tel3");
            const address = this.getAttribute("data-address");
            const building = this.getAttribute("data-building");
            const categoryId = this.getAttribute("data-category_id");
            const textarea = this.getAttribute("data-textarea");

            // モーダル内の情報を更新
            document.getElementById("modalFirstName").textContent = firstName;
            document.getElementById("modalLastName").textContent = lastName;
            document.getElementById("modalGender").textContent = gender;
            document.getElementById("modalEmail").textContent = email;
            document.getElementById("modalTel1").textContent = tel1;
            document.getElementById("modalTel2").textContent = tel2;
            document.getElementById("modalTel3").textContent = tel3;
            document.getElementById("modalAddress").textContent = address;
            document.getElementById("modalBuilding").textContent = building;
            document.getElementById("modalCategoryId").textContent = categoryId;
            document.getElementById("modalTextarea").textContent = textarea;

            // フォームの action を動的に変更
            document.getElementById("deleteForm").action = "/admin/contact/delete/" + contactId;
        });
    });
});
</script>
</body>
</html>