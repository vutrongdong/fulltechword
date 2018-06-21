export default {
    vi: {
        messages: {
            _default: (field) => `Thông tin ${field} không hợp lệ.`,
            alpha: (field) => `Thông tin ${field} phải chứa toàn bộ là ký tự chữ cái.`,
            confirmed: (field) => `Thông tin ${field} không khớp với giá trị cần xác thực.`,
            date_between: (field, [min, max]) => `Thông tin ${field} phải nằm trong khoảng ${min} và ${max}.`,
            date_format: (field, [format]) => `Thông tin ${field} phải đúng định dạng ${format}.`,
            decimal: (field, [decimals = '*'] = []) => `Thông tin ${field} phải là kiểu số và có thể chứa ${!decimals || decimals === '*' ? '' : decimals} số sau dấu chấm.`,
            digits: (field, [length]) => `Thông tin ${field} phải là kiểu số và chứa ${length} chữ số.`,
            dimensions: (field, [width, height]) => `Thông tin ${field} phải có kích thước chính xác là ${width} x ${height} pixels.`,
            email: (field) => `Thông tin ${field} phải là một địa chỉ email hợp lệ.`,
            ext: (field) => `Thông tin ${field} phải là một phần mở rộng hợp lệ.`,
            image: (field) => `Thông tin ${field} phải là dạng ảnh.`,
            included: (field) => `Thông tin ${field} phải là một giá trị hợp lệ.`,
            integer: (field) => `Thông tin ${field} phải là kiểu số nguyên.`,
            ip: (field) => `Thông tin ${field} phải là một địa chỉ IP hợp lệ.`,
            length: (field, [length, max]) => {
            if (max) {
              return `Thông tin ${field} có độ dài phải nằm trong khoảng ${length} và ${max}.`;
            }

            return `Thông tin ${field} có độ dài là ${length}.`;
            },
            max: (field, [length]) => `Thông tin ${field} không được vượt quá ${length} ký tự.`,
            max_value: (field, [max]) => `Thông tin ${field} phải từ ${max} trở xuống.`,
            mimes: (field) => `Thông tin ${field} phải là kiểu file hợp lệ.`,
            min: (field, [length]) => `Thông tin ${field} không được ít hơn ${length} ký tự.`,
            min_value: (field, [min]) => `Thông tin ${field} phải từ ${min} trở lên.`,
            numeric: (field) => `Thông tin ${field} phải là kiểu số.`,
            regex: (field) => `Thông tin ${field} có định dạng không hợp lệ.`,
            required: (field) => `Thông tin ${field} không được bỏ trống.`,
            size: (field, [size]) => `Thông tin ${field} có kích thước không vượt quá ${formatFileSize(size)}.`,
            url: (field) => `Thông tin ${field} phải là một địa chỉ url.`
        },
        attributes: {
            email: 'địa chỉ email'
        }
    }
}
