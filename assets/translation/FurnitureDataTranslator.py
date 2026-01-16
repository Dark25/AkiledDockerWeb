import json
import xml.etree.ElementTree as ET

todo_types = ["roomitemtypes", "wallitemtypes"]

# Función para normalizar los nombres de clase
def normalize_classnames(classname):
    return str(classname).replace("_", "").replace(" ", "")

# Diccionario para almacenar los muebles
furniture_dict = {}

# Cargar datos de 'furnidata.json' y 'productdata.json' y procesarlos
with open('assets/translation/gamedata/furnidata.json', 'r', encoding='utf-8') as f:
    furniture_data = json.load(f)
    for todo_type in todo_types:
        for furnitype in furniture_data[todo_type]["furnitype"]:
            classname = normalize_classnames(furnitype['classname'])
            furniture_dict[classname] = {
                "name": furnitype['name'],
                "description": furnitype['description'],
                "specialtype": furnitype['specialtype'] if 'specialtype' in furnitype else None,
                "canstandon": int(furnitype.get('canstandon', False)),
                "cansiton": int(furnitype.get('cansiton', False)),
                "canlayon": int(furnitype.get('canlayon', False)),
                "partcolors": furnitype.get('partcolors', []),
                "rentbuyout": int(furnitype.get('rentbuyout', False)),
                "bc": int(furnitype.get('bc', False)),
                "excludeddynamic": int(furnitype.get('excludeddynamic', False)),
                "rare": int(furnitype.get('rare', False))
            }
            if str(furniture_dict[classname]['description']).endswith("desc"):
                furniture_dict[classname]['description'] = ""

with open('assets/translation/gamedata/productdata.json', 'r', encoding='utf-8') as f:
    product_data = json.load(f)
    for product in product_data["productdata"]["product"]:
        classname = normalize_classnames(product['code'])
        furniture_dict[classname] = {
            "name": product['name'],
            "description": product['description'],
        }
        if str(furniture_dict[classname]['description']).endswith("desc"):
            furniture_dict[classname]['description'] = ""

# Cargar datos originales de muebles
orig_furniture_data = {}
with open('www/swfs/nitro/gamedata/FurnitureData.json', 'r', encoding='utf-8') as f:
    orig_furniture_data = json.load(f)

# Reemplazar los valores de nombre y descripción con los valores del diccionario
for todo_type in todo_types:
    for furnitype in orig_furniture_data[todo_type]["furnitype"]:
        classname = normalize_classnames(furnitype['classname'])
        if classname in furniture_dict:
            furnitype['name'] = furniture_dict[classname]['name']
            furnitype['description'] = furniture_dict[classname]['description']
            if "specialtype" in furniture_dict[classname]:
                furnitype['specialtype'] = furniture_dict[classname]['specialtype']
                furnitype['canstandon'] = furniture_dict[classname]['canstandon']
                furnitype['cansiton'] = furniture_dict[classname]['cansiton']
                furnitype['canlayon'] = furniture_dict[classname]['canlayon']
                furnitype['partcolors'] = furniture_dict[classname]['partcolors']
                furnitype['rentbuyout'] = furniture_dict[classname]['rentbuyout']
                furnitype['bc'] = furniture_dict[classname]['bc']
                furnitype['excludeddynamic'] = furniture_dict[classname]['excludeddynamic']
                furnitype['rare'] = furniture_dict[classname]['rare']
                
                # Cargar datos originales de muebles desde el archivo XML proporcionado
tree = ET.parse('www/swfs/gamedata/furnidata.xml')  # Reemplaza 'ruta/a/furnidata.xml' con la ruta correcta a tu archivo XML
root = tree.getroot()

# Crear el árbol XML
new_root = ET.Element("furnidata")
for todo_type in root:
    todo_type_element = ET.SubElement(new_root, todo_type.tag)
    for furnitype in todo_type:
        furnitype_attrib = {"id": furnitype.get("id"), "classname": furnitype.get("classname")}
        furnitype_element = ET.SubElement(todo_type_element, "furnitype", attrib=furnitype_attrib)
        for child in furnitype:
           
            if child.tag == 'partcolors':
                # Iterar sobre los colores y agregar cada uno como un elemento independiente
                partcolors_element = ET.SubElement(furnitype_element, "partcolors")
                for color in child:
                    color_element = ET.SubElement(partcolors_element, "color")
                    color_element.text = color.text
                continue
            furnitype_element.append(child)

# Guardar el archivo XML
new_tree = ET.ElementTree(new_root)
new_tree.write("furnidata_new.xml", encoding="utf-8", xml_declaration=True)