terraform {
  backend "s3" {
    bucket = "todoro-tfstate"
    key    = "todoro/prod/routing/todoro_tokyo_v1.0.0.tfstate"
    region = "ap-northeast-1"
  }
}
