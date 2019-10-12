export interface FileObject {
  name: string,
  status: string,
}

export interface FileInfo {
  file: FileInfo,
  name: string,
  status: string,
  fileList: Array<FileObject>,
}