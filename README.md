# 環境構築手順

  1. mainブランチで以下を実行
  ```
  docker compose up -d --build
  ```
  2. tailwindが効いていない場合はターミナルで以下を実行
  ```
  npm run dev
  ```

# 画面遷移
## ユーザー画面
1. ランディングページ: localhost:8080/intro.php

2. エージェント企業選択画面: localhost:8080/index.php
<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/c5535ad3-605e-456b-a031-36d090b4f6a1">

<details>

<summary>実装した機能</summary>

- カート機能
- 絞り込み機能（総合型or特化型）
- 並び替え機能
- 詳細画面

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/b157a6ed-c59a-4684-82a8-6516bc399922">

- レスポンシブ対応

</details>

3. 個人情報入力画面
<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/4b191ccf-80a5-467f-805b-14b6d53f5b1a">

<details>

<summary>実装した機能</summary>

- 申し込んだ企業が自動入力される
- バリデーション機能
- レスポンシブ対応

</details>

4.メールの受信: localhost:8025

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/9cc02956-bee1-4a6f-b4b2-d556e6d1ab1e">

<details>

<summary>実装した機能</summary>

- mailhogを利用して仮想的にメールを送信する
  - ユーザーに申し込み完了メールの送信
  - 就活エージェント企業に、学生が申請したことを知らせるメールを送信

</details>


## 管理者画面(WEBサイト自体の管理者画面)
1. ログイン画面: localhost:8080/auth/login.php
```
ログインメールアドレス: boozer@gmail.com
パスワード: password
```
2. 管理者画面

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/3ab0122e-41ca-4e4b-aee4-1aa02941400c">

<details>

<summary>実装した機能</summary>

- 就活エージェント企業の新規登録

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/573c7b1b-f3c4-47c2-90ae-788180870e4e">

- 詳細画面
  - その企業にどの学生が申し込んでいるのか
- 更新
- 削除

</details>

## 管理者画面(就活エージェント企業側の管理者画面)

1. ログイン画面: localhost:8080/auth/login.php

```
サービス名: Meets Company
email: meetscompany@gmail.com
password: meetscompany

サービス名: キャリアチケット
email: careerticket@gmail.com
password: careerticket

サービス名: リクナビ
email: rikunabi@gmail.com
password: rikunabi

サービス名: マイナビ新卒紹介
email: mainabi@gmail.com
password: mainabi

サービス名: アスリートエージェント
email: athleteagent@gmail.com
password: athleteagent

サービス名: レバテック
email: rebateck@gmail.com
password: rebateck
```

2. 管理者画面

<img width="500" alt="SCR-20230502-nedr" src="https://github.com/user-attachments/assets/a82ecd8b-ffc1-4277-a0f1-545912adc72a">

<details>

<summary>実装した機能</summary>

- 申請した学生一覧の表示
- 学生詳細画面
- CSVダウンロード機能

</details>


