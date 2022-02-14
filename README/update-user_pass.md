### 権限
必要

### エンドポイント
```
PUT https://goal-management.com/api/user/update_pass
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |
| 本文   | `current_password`         | 現在のパスワード           |
| 本文   | `new_password`         | 新しいパスワード           |

### 応答
| 名称        | 内容        |
|-----------|-----------|
| `message` | 成功時のメッセージ |

### 例
```js
{
    message:"passwordを変更しました。"
}
```
