> 🌐 **Ngôn ngữ:** 🇻🇳 Tiếng Việt (hiện tại) · [🇬🇧 English](./readme.md)

# Plugin Google reCAPTCHA cho GP247

## Giới thiệu

Plugin này giúp website GP247 của bạn chặn spam (đăng ký ảo, gửi form tự động) bằng ô xác thực **Google reCAPTCHA v2 — "Tôi không phải là người máy"** (ô tick vuông quen thuộc). Tài liệu dành cho **chủ shop / người quản trị không rành kỹ thuật**: đọc xong bạn tự đăng ký khóa Google, cài và bật captcha cho các trang như đăng ký, quên mật khẩu, thanh toán — mà không cần gọi thợ. Phần cuối có mục dành cho lập trình viên muốn gắn captcha vào form tự làm.

> ⚠️ **Quan trọng:** Từ bản 2.0, plugin dùng **reCAPTCHA v2 (ô tick "Tôi không phải là người máy")**, **không** phải reCAPTCHA v3. Khi đăng ký khóa ở Google bạn phải chọn đúng loại v2 (xem Bước 1), nếu chọn nhầm v3 thì ô tick sẽ không hiện và form luôn báo lỗi captcha.

## Điều kiện hoạt động (đọc kỹ trước khi cài)

Ô captcha **chỉ hiện ra** khi **đủ tất cả** các điều kiện dưới đây. Thiếu bất kỳ dòng nào là captcha sẽ không xuất hiện:

**Nhóm A — Bạn tự bật trong Admin (bắt buộc):**
1. Plugin **GoogleCaptcha** đã được **Install** và **Enable**.
2. Đã nhập cả **Site Key** và **Secret Key**, và đúng là khóa loại **reCAPTCHA v2 checkbox**.
3. Trong **Shop Config → tab Captcha**: đã bật trạng thái **ON**, đã chọn phương thức **Google reCaptcha**, và đã **tích chọn trang** muốn áp dụng.

**Nhóm B — Trang đó phải có "chỗ đặt" captcha:**
4. Chỉ những trang được GP247 hỗ trợ sẵn mới có chỗ hiện captcha. Hiện có 4 trang: **Đăng ký**, **Quên mật khẩu**, **Liên hệ**, **Thanh toán**. Trang nào không nằm trong danh sách này (hoặc chưa được tích ở bước 3) sẽ không có captcha.
5. Nếu bạn dùng **giao diện (template) tự chỉnh sửa**, form của trang đó phải giữ đúng dòng hiển thị captcha do GP247 cung cấp. Giao diện mặc định của GP247 đã có sẵn — chỉ cần lưu ý khi bạn tự sửa template (xem mục "Dành cho lập trình viên").

> 💡 Cách hiểu đơn giản: **Nhóm A** là "bạn đã bật đúng chưa", **Nhóm B** là "trang đó có hỗ trợ captcha không". Phải đúng cả hai thì ô tick mới hiện.

## Yêu cầu hệ thống

- GP247 phiên bản **2.0 trở lên**.
- Một **tài khoản Google** bất kỳ (Gmail) để đăng ký khóa reCAPTCHA (miễn phí).

## Bước 1 — Đăng ký Google reCAPTCHA v2 (lấy Site Key & Secret Key)

1. Mở trình duyệt, vào trang tạo khóa: [https://www.google.com/recaptcha/admin/create](https://www.google.com/recaptcha/admin/create)
2. **Đăng nhập** bằng tài khoản Google của bạn (nếu chưa đăng nhập).
3. Ở ô **Label** (Nhãn), gõ một tên gợi nhớ, ví dụ tên website của bạn: `shop-cua-toi`.
4. Ở mục **reCAPTCHA type** (Loại reCAPTCHA), chọn **Challenge (reCAPTCHA v2)**, rồi chọn tiếp **"I'm not a robot" Checkbox** (tiếng Việt: **Ô đánh dấu "Tôi không phải là người máy"**).

   > ⚠️ Đây là bước dễ sai nhất. **Phải** chọn v2 → ô tick, **không** chọn v3.
5. Ở mục **Domains** (Tên miền), thêm tên miền website của bạn, mỗi dòng một tên miền, **không kèm** `https://`. Ví dụ:

   ```
   shop-cua-toi.com
   www.shop-cua-toi.com
   ```

   Nếu đang chạy thử trên máy cá nhân, thêm cả `localhost`.
6. Tích vào ô đồng ý điều khoản (**Accept the reCAPTCHA Terms of Service**), rồi nhấn **Submit** (Gửi).
7. Nếu thành công, Google hiện ra **2 khóa**:
   - **Site Key** (Khóa trang / khóa công khai) — chuỗi bắt đầu bằng `6L...`
   - **Secret Key** (Khóa bí mật) — cũng bắt đầu bằng `6L...`

   Giữ nguyên trang này để lát nữa sao chép, hoặc copy 2 khóa ra một chỗ tạm (Notepad).

## Bước 2 — Cài đặt và bật plugin trong GP247

1. Đăng nhập **Admin Panel** của GP247.
2. Vào menu **Extension → Plugins**.
3. Tìm ô **GoogleCaptcha**, nhấn nút **Install** (Cài đặt).
4. Sau khi cài xong, ở ngay ô đó nhấn tiếp **Enable** (Bật). Nếu thành công, plugin chuyển sang trạng thái đang bật.

## Bước 3 — Nhập Site Key & Secret Key

1. Vẫn trong **Extension → Plugins**, nhấn vào **GoogleCaptcha** để mở màn cấu hình.
2. Dán 2 khóa lấy ở Bước 1 vào đúng ô:
   - **Site key** ← dán **Site Key** của Google.
   - **Secret key** ← dán **Secret Key** của Google.
3. Nhấn **Save** (Lưu). Nếu thành công sẽ có thông báo lưu thành công.

## Bước 4 — Bật captcha và chọn trang áp dụng

1. Vào **Shop Setting → Shop Config**.
2. Chọn tab **Captcha**.
3. Chuyển trạng thái captcha sang **ON**.
4. Ở mục phương thức, chọn **Google reCaptcha**.
5. **Tích chọn các trang** muốn hiện captcha: **Đăng ký**, **Quên mật khẩu**, **Liên hệ**, **Thanh toán** (chọn bao nhiêu tùy bạn).
6. Nhấn **Save** (Lưu).

## Kiểm tra hoạt động

1. Mở website ở chế độ khách (hoặc trình duyệt ẩn danh), vào trang **Đăng ký**.
2. Nếu cấu hình đúng, ngay trong form sẽ hiện ô **"Tôi không phải là người máy"**.
3. Tick vào ô đó, điền thông tin rồi nhấn nút đăng ký. Nếu chưa tick mà bấm gửi, form sẽ báo lỗi captcha và không cho qua.

## Dành cho lập trình viên — gắn captcha vào form tự làm

Từ bản 2.0, cơ chế cũ dùng `idForm` / `idButtonForm` **đã bị bỏ** (nó phụ thuộc ID cố định mà giao diện mới không còn). Cách mới **không cần ID**: chỉ cần đặt widget **bên trong** thẻ `<form>`, Google sẽ tự chèn dữ liệu xác thực vào đúng form đó.

Cách chuẩn (giống các form mặc định của GP247): trong controller của trang, lấy sẵn phần captcha rồi truyền ra view:

```php
// Trong controller: 'register' là tên trang, phải khớp trang đã tích ở Bước 4
$viewCaptcha = gp247_captcha_processview('register', 'Đăng ký');
// ... truyền $viewCaptcha ra view
```

Trong file view, in nó **bên trong** thẻ `<form>`, phía trên nút gửi:

```blade
<form method="POST" action="...">
    @csrf
    {{-- ...các ô nhập... --}}

    {!! $viewCaptcha ?? '' !!}

    <button type="submit">Gửi</button>
</form>
```

Các tên trang hợp lệ (khớp với danh sách tích ở Bước 4): `register`, `forgot`, `contact`, `checkout`.

## Xử lý lỗi phổ biến

- **Không thấy ô captcha đâu cả** → kiểm tra lần lượt: plugin đã Enable chưa; đã nhập Site Key chưa; ở Shop Config → Captcha đã bật ON và đã **tích đúng trang** đang xem chưa (xem lại mục "Điều kiện hoạt động").
- **Ô captcha hiện nhưng gửi form luôn báo lỗi** → thường do **Secret Key sai**, hoặc bạn lỡ đăng ký nhầm **khóa v3** thay vì v2. Đăng ký lại khóa đúng loại v2 (Bước 1).
- **Google báo "Tên miền không hợp lệ" / ô captcha kêu lỗi domain** → tên miền website chưa được thêm vào mục **Domains** ở trang quản trị Google reCAPTCHA (Bước 1, mục 5).
- **Trên máy chạy thử không hiện** → thêm `localhost` vào mục Domains của khóa.

## Gỡ cài đặt

1. Vào **Extension → Plugins**, tìm **GoogleCaptcha**.
2. Nhấn **Disable** để tạm tắt.
3. Nhấn **Uninstall** để gỡ hẳn (xóa cấu hình khóa đã lưu).

## Ghi chú nâng cấp (bản 2.0)

- Chuyển từ **reCAPTCHA v3** sang **reCAPTCHA v2 checkbox** để hoạt động ổn định với giao diện mới (TailAdmin/Livewire), không còn phụ thuộc ID form/nút cố định.
- Màn cấu hình admin dựng lại bằng TailAdmin/Livewire; Site Key và Secret Key vẫn lưu ở đúng các dòng `admin_config` như trước nên giá trị đã cấu hình **được giữ nguyên** khi nâng cấp.

## Hỏi & Đáp (Q&A)

**Câu 1: Plugin dùng reCAPTCHA v2 hay v3?**
Bản 2.0 dùng **v2 checkbox** (ô tick "Tôi không phải là người máy"). Khi đăng ký khóa ở Google phải chọn đúng loại này.

**Câu 2: Tôi đã có khóa reCAPTCHA v3 từ trước, dùng lại được không?**
Không. Khóa v3 và v2 khác nhau. Bạn cần đăng ký lại một cặp khóa **v2 checkbox** mới theo Bước 1.

**Câu 3: Đã bật đủ mà vẫn không thấy ô captcha ở trang đăng ký?**
Kiểm tra lại **Điều kiện hoạt động**: hay gặp nhất là chưa **tích trang "Đăng ký"** trong Shop Config → Captcha, hoặc chưa nhập Site Key.

**Câu 4: Captcha chỉ hiện ở một số trang, các trang khác không có?**
Đúng như thiết kế — captcha chỉ hiện ở các trang bạn **tích chọn** ở Bước 4, và chỉ trong nhóm trang GP247 hỗ trợ (đăng ký, quên mật khẩu, liên hệ, thanh toán).

**Câu 5: reCAPTCHA có tính phí không?**
Không. Google reCAPTCHA v2 miễn phí cho nhu cầu thông thường.

**Câu 6: Đổi tên miền website thì cần làm gì?**
Vào trang quản trị Google reCAPTCHA, thêm tên miền mới vào mục **Domains** của khóa đang dùng (không cần tạo khóa mới).

**Câu 7: Muốn thêm captcha vào một form do tôi tự làm thì sao?**
Xem mục "Dành cho lập trình viên": đặt `{!! $viewCaptcha !!}` bên trong thẻ `<form>` và gọi `gp247_captcha_processview(...)` trong controller. Không cần khai báo ID form/nút như bản cũ.

**Câu 8: Tôi lỡ nhập sai Secret Key thì có báo gì không?**
Ô captcha vẫn hiện bình thường, nhưng khi gửi form sẽ luôn báo lỗi xác thực. Vào lại màn cấu hình plugin nhập lại đúng Secret Key.

**Câu 9: Gỡ plugin có mất Site Key / Secret Key đã nhập không?**
Nhấn **Disable** chỉ tạm tắt, giữ lại khóa. Nhấn **Uninstall** sẽ xóa hẳn cấu hình khóa; muốn dùng lại phải nhập lại.

**Câu 10: Nâng từ bản 1.x lên 2.0 có phải nhập lại khóa không?**
Không. Khóa được giữ nguyên vì vẫn lưu ở cùng vị trí cũ. Bạn chỉ cần đảm bảo khóa đang dùng là loại **v2 checkbox**; nếu trước đây là v3 thì phải đăng ký lại theo Bước 1.

---

<sub>📅 **Cập nhật lần cuối:** 2026-08-03 · ✍️ **Tác giả (Author):** GP247</sub>
