export interface IFileObject {
  name: string;
  status: string;
}

export interface IFileInfo {
  file: IFileInfo;
  name: string;
  status: string;
  fileList: IFileObject[];
}
