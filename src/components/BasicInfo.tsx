import {
  AutoComplete, DatePicker, Input, PageHeader, Select, Tree,
} from "antd";
import React, { Component } from "react";
import Form from "../antd/Form";

const { Item } = Form;
const { Option } = Select;
const { TreeNode } = Tree;
const { Search } = Input;
const { TextArea } = Input;

interface IProps {
}

interface IState {
  isUploading: false;
}

const formItemLayout = {
  labelCol: {
    xs: { span: 24 },
    sm: { span: 5 },
  },
  wrapperCol: {
    xs: { span: 24 },
    sm: { span: 12 },
  },
};

class BasicInfo extends Component<IProps, IState> {
  public render() {
    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Basic Info" subTitle="Đây là các thông tin cơ bản của truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          <Item
          label="Alternatve Name"
          >
            <Input name="alternative_name" />
          </Item>

          <Item
            label="Comic Type"
          >
            <Select
              showSearch
              style={{ width: 200 }}
              placeholder="Select comic type"
              mode="tags"
              optionFilterProp="children"
              filterOption={(input: string, option: any) =>
                option.props.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
              }
            >
              <Option value="manga">Manga</Option>
              <Option value="manhua">Manhua</Option>
              <Option value="manhwa">Manhwa</Option>
            </Select>
          </Item>
          <Item
            label="Status"
          >
            <Select
              style={{ width: 200 }}
              placeholder="The status of the comic"
            >
              <Option value="manga">On Going</Option>
              <Option value="manhua">Pending</Option>
              <Option value="manhwa">Completed</Option>
            </Select>
          </Item>

          <Item
            label="Release Year"
          >
            <DatePicker
              style={{width: 200}}
              mode="year"
            />
          </Item>

          <Item
            label="Authors"
          >
            <Select
              mode="multiple"
              style={{ width: "100%" }}
              placeholder="Please select"
              defaultValue={["option1", "option2"]}
            >
              <Option key="option1">Option 1</Option>
              <Option key="option2">Option 2</Option>
            </Select>
          </Item>

          <Item label="Artists">
          <AutoComplete style={{ width: "100%" }} placeholder="Tiểu Tôn Tuyết Đăng">
            <AutoComplete.Option key="option1">Opion 1</AutoComplete.Option>
          </AutoComplete>
          </Item>

          <Item
            label="Genres"
          >
            <Search style={{ marginBottom: 8 }} placeholder="Search" />
            <Tree
              checkable
              defaultExpandedKeys={['0-0-0', '0-0-1']}
              defaultSelectedKeys={['0-0-0', '0-0-1']}
              defaultCheckedKeys={['0-0-0', '0-0-1']}
            >
              <TreeNode title="parent 1" key="0-0">
                <TreeNode title="parent 1-0" key="0-0-0" disabled>
                  <TreeNode title="leaf" key="0-0-0-0" disableCheckbox />
                  <TreeNode title="leaf" key="0-0-0-1" />
                </TreeNode>
                <TreeNode title="parent 1-1" key="0-0-1">
                  <TreeNode title={<span style={{ color: '#1890ff' }}>sss</span>} key="0-0-1-0" />
                </TreeNode>
              </TreeNode>
            </Tree>
          </Item>

          <Item
            label="Short Description"
          >
            <TextArea name="exceprt" rows={4} />
          </Item>
        </Form>
      </div>
    );
  }
}

export default BasicInfo;
